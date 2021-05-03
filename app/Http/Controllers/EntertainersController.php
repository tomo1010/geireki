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
        $entertainers = Entertainer::all();
        
        $active = Entertainer::select('active')->get();
        $today = new Carbon();
        $diff = array();

    
        // 活動開始年から芸歴を取得        
        foreach($active as $value){
            $value = $value->active;
            $value = new Carbon($value);
            $diff[] = $value->diffInYears($today);
        }
            //dd($value);


        // 芸歴を検索する処理
        $year = '2000';
        $results = Entertainer::whereYear('active','>=', $year)->get();
        //dd($result);

        
        // 一覧ビューでそれを表示
        return view('entertainers.index', [
            'entertainers' => $entertainers,
            'diff' => $diff,
            'results' => $results,
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

        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
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



    //csvインポート処理

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
                'alias' => $row[2],
                'active' => $row[3],
                'activeend' => $row[4],
                'master' => $row[5],
                'oldname' => $row[6],
                'official' => $row[7],
                'youtube' => $row[8],
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '組登録しました！');
    }
}
