<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;

use Carbon\Carbon; //芸歴計算

use Goodby\CSV\Import\Standard\LexerConfig; //csvインポート
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;


class EntertainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 一覧を取得
        $entertainersAll = Entertainer::sortable()->orderBy('active', 'desc')->paginate(5);
        
        //↑一覧から、解散済み、芸歴65年以上データ無しを除いて取得
        $overyear = Carbon::now()->subYear(65); // ６５年目を取得
        $entertainers = Entertainer::where('activeend', NULL)->where('active', '<=', $overyear)->sortable()->orderBy('active', 'desc')->paginate(5);
        


        //活動終了入力の場合、活動開始から計算して芸歴を固定する
        $cal = Entertainer::where('activeend', '!=', NULL)->get();      
        $diff = array();

        foreach($cal as $value){
            $active = $value->active;
            $activeend = $value->activeend;
            $diff[] = $active->diffInYears($activeend);
        }

        //dd($diff);


    
        // 芸歴別に人数をカウントし一覧
        $years = array();
        $counts = array();
        $results_1 = array();
        $results_2 = array();
        $results_3 = array();

        for($i=0; $i<=70; $i++){
            $years[] = Carbon::now()->subYear($i); //今日から「○年前」を取得
        }

        foreach($years as $year){
            $counts[] = Entertainer::whereYear('active','=', $year)->count(); //「○年前」の芸人の数を取得
            $results_1[] = Entertainer::whereYear('active','=', $year)->where('numberofpeople','=', '1')->count();
            $results_2[] = Entertainer::whereYear('active','=', $year)->where('numberofpeople','=', '2')->count();
            $results_3[] = Entertainer::whereYear('active','=', $year)->where('numberofpeople','=', '3')->count();
        }




        //今年解散した芸人の一覧
        $lastyear = Carbon::now()->subYear(0); // 今年を取得
        $dissolutions = Entertainer::whereYear('activeend','=', $lastyear)->get();


        //芸歴15年目の芸人の一覧
        $m1year = Carbon::now()->subYear(15); // １５年目を取得
        $m1year = Entertainer::whereYear('active','=', $m1year)->where('activeend', '=', NULL)->where('numberofpeople', '=', '2')->get();



        // 一覧ビューで表示
        return view('entertainers.index', [
            'entertainers' => $entertainers,
            'entertainersAll' => $entertainersAll,
            'counts' => $counts,
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,        
            'now' => new \Carbon\Carbon(),
            'dissolutions' => $dissolutions,
            'm1year' => $m1year,
        ]);
        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entertainer = new Entertainer;

        // 作成ビューを表示
        return view('entertainers.create', [
            'entertainer' => $entertainer,
        ]);
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /** バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'numberofpeople' => 'required|max:255',
            'alias' => 'required|max:255',
            'active' => 'required|max:255',
            'activeend' => 'required|max:255',
            'master' => 'required|max:255',
            'oldname' => 'required|max:255',
            'official' => 'required|max:255',
            'youtube' => 'required|max:255',
        ]);
        */

        // 作成
        $entertainer = new Entertainer;
        $entertainer->name = $request->name;
        $entertainer->numberofpeople = $request->numberofpeople;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->save();

        // トップページへリダイレクトさせる
        return redirect('/');

    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $entertainer = Entertainer::findOrFail($id);
        
        // 活動開始年から芸歴を取得
        $active = $entertainer->active;
        
        // 同期芸人を取得
        $sync = Entertainer::whereYear('active','=', $active)->where('id','!=',$id)->get();

        // 1年後輩を取得
        $year = new Carbon($active);
        $addYear = $year->addYear();
        $junior = Entertainer::whereYear('active','=', $addYear)->get();

        // 1年先輩を取得
        $year = new Carbon($active);
        $subYear = $year->subYear();
        $senior = Entertainer::whereYear('active','=', $subYear)->get();

        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
            'sync' => $sync,
            'junior' => $junior,
            'senior' => $senior,
            'now' => new \Carbon\Carbon(),
        ]);
    }








    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値で検索して取得
        $entertainer = Entertainer::findOrFail($id);

        // 編集ビューでそれを表示
        return view('entertainers.edit', [
            'entertainer' => $entertainer,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $entertainer = Entertainer::findOrFail($id);
        // メッセージを更新
        $entertainer->name = $request->name;
        $entertainer->numberofpeople = $request->numberofpeople;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->save();

        // トップページへリダイレクトさせる
        return redirect('/');
        //return back();
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $entertainer = Entertainer::findOrFail($id);
        // メッセージを削除
        $entertainer->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
 
 
 
 
    

    //csvアップロード画面
    
    public function uploadcsv()
    {
        return view("entertainers.upload");
    }



    // csvインポート処理

    public function importCsv(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
 
        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
 
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);
 
        $dataList = [];
     
        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });
 
        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);
 
        // TMPファイル削除
        unlink($tmpPath);
 
        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Entertainer::insert([
                'name' => $row[0], 
                'numberofpeople' => $row[1],
                'gender' => $row[2],
                'alias' => $row[3],
                'active' => $row[4],
                'activeend' => $row[5] == '' ? NULL : $row[5],
                'master' => $row[6],
                'oldname' => $row[7],
                'official' => $row[8] == '' ? NULL : $row[8],
                'youtube' => $row[9] == '' ? NULL : $row[9],
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '組登録しました！');
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($year)
    {
        //芸歴○年別で一覧表示
        $entertainers = Entertainer::sortable()->orderBy('active')->get();// 一覧を取得
        $listyear = Carbon::now()->subYear($year); // 芸歴○年目を取得
        
        $results_1 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '1')->get();
        $results_2 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '2')->get();
        $results_3 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '3')->get();
        
        
        // 一覧ビューで表示
        return view('entertainers.list', [
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,
            'year' => $year,
            'now' => new \Carbon\Carbon(),
        ]);
    }
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selectYear(Request $request)
    {
        //indexのプルダウンから受け取った年数をlistControllerへ渡すだけの処理
        $year = $request->year;
        return redirect()->action('EntertainersController@list',['year' => $year]);
    }
    


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkDissolution(Request $request)
    {
        //indexのチェックボックスをindexControllerへ渡すだけの処理
        $check = $request->check;
        //dd($check);
        return redirect()->action('EntertainersController@index',['check' => $check]);
    }



}
