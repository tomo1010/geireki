<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Youtube;
use App\Member;
use App\Award;
use App\User;

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


        //本日・明日の誕生日を表示
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $birthday = array();
        $birthdayTomorrow = array();
        //$limit = $today->subYear(90); 表示する年齢制限
        
        $perfomers = Perfomer::with(['entertainer'])->where('deth', '=', NULL)->orderBy('birthday', 'asc')->get();

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



        //最新のYoutube動画一覧
        $youtubes = Youtube::latest()->take(3)->get();
        $count = $youtubes->count();        

//dd($youtubes);

        //Youtubeのサムネイルを取得
        if (empty($count)) {
            //nullの場合何もしない
            $iflame = array();     //初期化
                $iframe[] = "-";
            
        }else{
            $iflame = array();     //初期化     
            
            foreach($youtubes as $value){
                
                if (strpos($value->youtube, "watch") != false) //ページURL?
            	
            	{
            		/** コード変換 */
                	$code = htmlspecialchars($value->youtube, ENT_QUOTES);        		
            		$code = substr($value->youtube, (strpos($code, "=")+1));
            	}
            	else
            	{
            		/** 短縮URL用に変換 */
                	$code = htmlspecialchars($value->youtube, ENT_QUOTES);
            		$code = substr($value->youtube, (strpos($code, "youtu.be/")+9));
            	}
            
                //$iframe[] = "<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/{$code}\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                $iframe[] = "http://img.youtube.com/vi/{$code}/2.jpg";
            }            
        }





        //今年解散した芸人の一覧
        $lastyear = Carbon::now()->subYear(0); // 今年を取得
        $dissolutions = Entertainer::whereYear('activeend','=', $lastyear)->orderBy('active', 'asc')->get();


        //芸歴15年目の芸人の一覧
        $m1year = Carbon::now()->subYear(15); // １５年目を取得
        $m1year = Entertainer::with('office')->whereYear('active','=', $m1year)->where('activeend', '=', NULL)->where('numberofpeople', '=', '2')->get();


//dd($birthday);


        // 一覧ビューで表示
        return view('index', [
            'now' => new \Carbon\Carbon(),
            'dissolutions' => $dissolutions,
            'm1year' => $m1year,
            'birthday' => $birthday,
            'birthdayTomorrow' => $birthdayTomorrow,
            'youtubes' => $youtubes,
            'iframe' => $iframe,            
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
        $entertainer->brain = $request->brain;
        $entertainer->encounter = $request->encounter;        
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
        $entertainer = Entertainer::with('perfomers')->findOrFail($id);
        // $entertainer = Entertainer::with(['perfomers.office', 'office'])->findOrFail($id);
        //dd($entertainer);

        // 活動開始年から芸歴を取得
        $active = $entertainer->active;
        
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        
        /*
        関連芸人を取得　同期、1年先輩、1年後輩
        */
        
        if($disband == '1'){
        
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
        }
        
        else{
        
            // 同期芸人を取得
            $sync = Entertainer::where('activeend', NULL)->whereYear('active','=', $active)->where('id','!=',$id)->get();
    
            // 1年後輩を取得
            $year = new Carbon($active);
            $addYear = $year->addYear();
            $junior = Entertainer::where('activeend', NULL)->whereYear('active','=', $addYear)->get();
    
            // 1年先輩を取得
            $year = new Carbon($active);
            $subYear = $year->subYear();
            $senior = Entertainer::where('activeend', NULL)->whereYear('active','=', $subYear)->get();            
        }
        
        
        
        //所属事務所
        $office = Entertainer::find($id)->office;

        //受賞歴
        $award = Entertainer::find($id)->award;    
        
        //dd($award);

        //メンバー（個人）を取得
        //$perfomer = Entertainer::find($id)->perfomers();

        
        //Youtubeを取得
        $youtubes = Entertainer::find($id)->youtubes;
        $count = $youtubes->count();
        
        //dd($count);

        //Youtubeのサムネイルを取得
        if (empty($count)) {
            //nullの場合何もしない
            $iflame = array();     //初期化
                $iframe[] = "-";
            
        }else{
            $iflame = array();     //初期化     
            
            foreach($youtubes as $value){
                
                if (strpos($value->youtube, "watch") != false) //ページURL?
            	
            	{
            		/** コード変換 */
                	$code = htmlspecialchars($value->youtube, ENT_QUOTES);        		
            		$code = substr($value->youtube, (strpos($code, "=")+1));
            	}
            	else
            	{
            		/** 短縮URL用に変換 */
                	$code = htmlspecialchars($value->youtube, ENT_QUOTES);
            		$code = substr($value->youtube, (strpos($code, "youtu.be/")+9));
            	}
            
                //$iframe[] = "<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/{$code}\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                $iframe[] = "http://img.youtube.com/vi/{$code}/2.jpg";
            }            
        }

            

//dd($iframe);

        // $youtubecounts = $youtubes->loadRelationshipCounts();

        // dd($youtubecounts);
        
        
        if (\Auth::check()) {
            $user = \Auth::user();  // 認証済みユーザを取得
        } 
        



        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
            'sync' => $sync,
            'junior' => $junior,
            'senior' => $senior,
            'now' => new \Carbon\Carbon(),
            'office' => $office,
            'award' => $award,            
            //'perfomer' => $perfomer,
            'youtubes' => $youtubes,
            'iframe' => $iframe,
            // 'user' => $user,
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
        $entertainer = Entertainer::with('perfomers')->findOrFail($id);
        $member = Member::where('entertainer_id',$id)->get();

//dd($member);

        // 編集ビューでそれを表示
        return view('entertainers.edit', [
            'entertainer' => $entertainer,
            'member' => $member,
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
        //$member = array();
        
        // メッセージを更新
        $entertainer->name = $request->name;
        $entertainer->numberofpeople = $request->numberofpeople;
        $entertainer->gender = $request->gender;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->brain = $request->brain;        
        $entertainer->encounter = $request->encounter;                
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->tiktok = $request->tiktok;      
        $entertainer->office_id = $request->office_id;
        //$member = $request->perfomer_id;

//dd($request->perfomer_id);

        $entertainer->perfomers()->sync($request->perfomer_id); //中間テーブルを更新した時        
        
        $entertainer->save();





        // 元のページへリダイレクトさせる
        //return redirect('/');
        //return back();
        return redirect($request->back_url);

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
    public function searchbox(Request $request)
    {
           
        $search = $request->search;           

        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        // $disband = request('disband');

        // if($disband == '1'){
        //     $search_1 = Entertainer::where('name', 'like', "%$search%")->get();
        //     $search_2 = Perfomer::where('name', 'like', "%$search%")->get();           
        // }
        // else{
        //     $search_1 = Entertainer::where('activeend', NULL)->where('name', 'like', "%$search%")->get();
        //     $search_2 = Perfomer::where('activeend', NULL)->where('name', 'like', "%$search%")->get();           
        // }

           
           
          $search_1 = Entertainer::where('name', 'like', "%$search%")->get();
          $search_2 = Perfomer::where('name', 'like', "%$search%")->get();           
        
            // 一覧ビューで表示
            return view('searchbox', [
            'search_1' => $search_1,
            'search_2' => $search_2,            
            'now' => new \Carbon\Carbon(),
        ]);
            
            


    }






     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
  
  
    public function all()
    {
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){
            // 一覧を取得
            $entertainers = Entertainer::sortable()->orderBy('active', 'desc')->paginate(50);
        }
        else{
            //解散済みを除いて取得
            $entertainers = Entertainer::where('activeend', NULL)->sortable()->orderBy('active', 'desc')->paginate(50);
        }
        
        
        // ビューで表示
        return view('entertainers.all', [
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
        
    }







}
