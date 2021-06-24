<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Youtube;

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
        // dd(Perfomer::with('entertainer')->get()[1000]);
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');


        if($disband == '1'){
            // 一覧を取得
            $entertainers = Entertainer::sortable()->orderBy('active', 'desc')->paginate(5);
            }
        
        else{
            //↑一覧から、解散済み、芸歴65年以上データ無しを除いて取得
            //$overyear = Carbon::now()->subYear(65); // ６５年目を取得
            //->where('active', '<', $overyear)
            $entertainers = Entertainer::where('activeend', NULL)->sortable()->orderBy('active', 'desc')->paginate(5);
            }



        /*活動終了入力の場合、活動開始から計算して芸歴を固定する
        $cal = Entertainer::where('activeend', '!=', NULL)->get();      
        $diff = array();

        foreach($cal as $value){
            $active = $value->active;
            $activeend = $value->activeend;
            $diff[] = $active->diffInYears($activeend);
        }

        //dd($diff);
        */

    
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



        //本日・明日の誕生日を表示
        $perfomers = Perfomer::get();
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $birthday = array();
        $birthdayTomorrow = array();

        foreach($perfomers as $value){
            $day = $value->birthday;
            if($day !== NULL){
                if($day->isBirthday($today)){
                    $birthday[] = $value;
                }
            }
        }    
        
        foreach($perfomers as $value){
            $day = $value->birthday;
            if($day !== NULL){
                if($day->isBirthday($tomorrow)){
                    $birthdayTomorrow[] = $value;
                }
            }    
        }


        //事務所別に人数を表示
        $office = Office::all();
        foreach($office as $value){
            $value->loadRelationshipCounts();  // 関係するモデルの件数をロード
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
            //'entertainersAll' => $entertainersAll,
            'counts' => $counts,
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,        
            'now' => new \Carbon\Carbon(),
            'dissolutions' => $dissolutions,
            'm1year' => $m1year,
            'office' => $office,
            'birthday' => $birthday,
            'birthdayTomorrow' => $birthdayTomorrow,
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
        $entertainer->gender = $request->gender;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->office_id = $request->office_id;        
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
        $sync_1 = Perfomer::whereYear('active','=', $active)->where('entertainer_id','=',NULL)->where('id','!=',$id)->get();

        // 1年後輩を取得
        $year = new Carbon($active);
        $addYear = $year->addYear();
        $junior = Entertainer::whereYear('active','=', $addYear)->get();

        // 1年先輩を取得
        $year = new Carbon($active);
        $subYear = $year->subYear();
        $senior = Entertainer::whereYear('active','=', $subYear)->get();
        
        
        //所属事務所
        $office = Entertainer::find($id)->office;


        //メンバー（個人）を取得
        $perfomer = Entertainer::find($id)->perfomers;
        
        
        //Youtubeを取得
        $youtube = Entertainer::find($id)->youtubes;


        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
            'sync' => $sync,
            'sync_1' => $sync_1,
            'junior' => $junior,
            'senior' => $senior,
            'now' => new \Carbon\Carbon(),
            'office' => $office,
            'perfomer' => $perfomer,
            'youtube' => $youtube,
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
        $entertainer->office_id = $request->office_id;
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
        
        $results_1 = Perfomer::whereYear('active','=', $listyear)->where('entertainer_id','=', NULL)->get();
        $results_2 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '2')->get();
        $results_3 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '3')->get();
        
        //dd($results_1);
        
        
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
