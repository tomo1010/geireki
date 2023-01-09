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
use App\Tag;

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
    public function index(Request $request)
    {

        /*
        本日・明日の誕生日を表示
        */
        
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $birthday = array();
        $birthdayTomorrow = array();
        //$limit = $today->subYear(90); 表示する年齢制限
        
        // $perfomers = Perfomer::with(['entertainer'])->whereNull('deth')->whereNull('activeend')->orderBy('birthday', 'asc')->get();

        $perfomers = Perfomer::with(['entertainer'=> function ($query) {
                         $query->whereNull('activeend');
                     }])->whereNull('deth')->whereNull('activeend')->orderBy('birthday', 'asc')->get();


        //本日誕生日を取得
        foreach($perfomers as $value){
            $day = $value->birthday;
            if($day !== NULL){
                if($day->isBirthday($today)){
                    $birthday[] = $value;
                }
            }
        }
    

//dd($perfomers);
        

        //明日誕生日を取得        
        foreach($perfomers as $value){
            $day = $value->birthday;
            if($day !== NULL){
                if($day->isBirthday($tomorrow)){
                    $birthdayTomorrow[] = $value;
                }
            }    
        }



        /*
        新着Tag芸人
        */
        
        //$tags = Entertainer::all()->tags()->orderBy('created_at', 'desc')->take(3)->get();
        //$updates = Entertainer::orderBy('update_at', 'decs')->take(3)->get();        



        /*
        新しく登録された芸人
        */
        
        $creates = Entertainer::whereNotNull('created_at')->orderBy('created_at', 'desc')->take(3)->get();
        //$updates = Entertainer::orderBy('update_at', 'decs')->take(3)->get();        



        /*
        今年の大会結果
        */

        $year = $today->year; //誕生日で作ったcarbon$todayを再利用
        $awards = Award::where('year', '=' , $year)->orderBy('id','desc')->get();
    //dd($awards);



        /*
        新着ネタ動画　Youtube動画一覧
        */
        
        $youtubes = Youtube::latest()->take(3)->get();
        $count = $youtubes->count();        

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



        // //本日の芸人ガチャ
        // $gacha = request('gacha');
        // if($gacha == '1'){
        //     $gacha = Perfomer::inRandomOrder()->where('activeend', '=', NULL)->first();
        // }else{
        //     $gacha = null;
        // }


        //本日のギャグガチャ
        $gacha = request('gacha');
        if($gacha == '1'){
            $gacha = Perfomer::inRandomOrder()->whereNotNull('gag')->first();

            $gag = explode('/', $gacha->gag ); //スラッシュ区切りで配列へ格納
            $gag = $gag[ array_rand( $gag ) ] ; //配列からランダムに1個取得

        }else{
            $gacha = null;
            $gag = null;
        }



        //NSC出身だけど非吉本の芸人の一覧
        $nsc = Perfomer::inRandomOrder()->whereHas('office',function($query){
            $query->where('id','!=','108');
            $query->where('id','!=','146');            
        })->where('school','like', '%NSC%')->where('activeend','=', NULL)->take(5)->get();
        

        
        //最新のM1結果
        $m1 = Award::with('entertainer')->where('year', '2022')->where('award', 'like','%M-1グランプリ%')->orderBy('rank', 'asc')->get();
        
        //最新のKOC結果
        $koc = Award::with('entertainer')->where('year', '2022')->where('award', 'like','%キングオブコント%')->orderBy('rank', 'asc')->get();


        // 一覧ビューで表示
        return view('index', [
            'now' => new \Carbon\Carbon(),
            'dissolutions' => $dissolutions,
            'm1year' => $m1year,
            'birthday' => $birthday,
            'birthdayTomorrow' => $birthdayTomorrow,
            'youtubes' => $youtubes,
            'iframe' => $iframe,   
            'gacha' => $gacha,
            'gag' => $gag,  
            'nsc' => $nsc,
            'm1' => $m1,            
            'koc' => $koc,  
            'creates' => $creates,
            'awards' => $awards,
            //'updates' => $updates,                    
                        
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
        
        
        // バリデーション
        $request->validate([
            'name' => 'required|max:255|unique:entertainers,name',
            'numberofpeople' => 'required|max:10',
            'gender' => 'required|max:10',
            'office_id' => 'required|max:10',                
        ]);
        

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
        $entertainer->named = $request->named;
        $entertainer->memo = $request->memo;                
        $entertainer->official = $request->official;
        $entertainer->twitter = $request->twitter;                
        $entertainer->youtube = $request->youtube;
        $entertainer->office_id = $request->office_id;        
        $entertainer->save();

        // 投稿したページへリダイレクトさせる
        return redirect()->action('EntertainersController@show', ['id' => $entertainer->id]);


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

        //Youtubeを取得
        $youtubes = Entertainer::find($id)->youtubes;
        $count = $youtubes->count();

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
        
        if (\Auth::check()) {
            $user = \Auth::user();  // 認証済みユーザを取得
        } 



        //タグを取得
        $tags = Tag::all()->groupBy('category');
        
//dd($tags);


        /*
        タグをカテゴリーと名前で分ける
        */
        // $taglists = $tags->mapToGroups(function ($item, $key) {
        //     return [$item['category'] => $item['name']];
        // });


//dd($tags[2]->id);

        // foreach($taglists as $category => $name){
        //     //dd($category,$name);
        //     foreach($name as $value){
        //     dd($value,$tags[$loop->index]->id);
        //     }
        // }

        
        //dd($taglists);

        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
            'sync' => $sync,
            'junior' => $junior,
            'senior' => $senior,
            'now' => new \Carbon\Carbon(),
            'office' => $office,
            'award' => $award,            
            'youtubes' => $youtubes,
            'iframe' => $iframe,
            'tags' => $tags,            
            //'taglists' => $taglists,
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
        $entertainer->named = $request->named;  
        $entertainer->memo = $request->memo;          
        $entertainer->official = $request->official;
        $entertainer->twitter = $request->twitter;  
        $entertainer->youtube = $request->youtube;
        $entertainer->tiktok = $request->tiktok;      
        $entertainer->office_id = $request->office_id;

//dd($request->perfomer_id);


        /*
        メンバー（中間テーブル）更新処理
        */


        
        // if(!empty($request->newPerfomer_id)){
        //     $entertainer->perfomers()->attach($request->newPerfomer_id); //新しくperfomer_idを追加した場合
        // }
//        else{
            $entertainer->perfomers()->sync(array_filter($request->perfomer_id)); //すでにあるperfomer_idを更新した場合            
//        }
        
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

          $entertainer = Entertainer::where('name', 'like', "%$search%")->get();
          $perfomer = Perfomer::where('name', 'like', "%$search%")->get();           
        
            // 一覧ビューで表示
            return view('searchbox', [
            'entertainer' => $entertainer,
            'perfomer' => $perfomer,            
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
