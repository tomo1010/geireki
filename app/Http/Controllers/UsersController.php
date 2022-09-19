<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加
use App\Youtube; // 追加
use App\Perfomer; // 追加
use App\Entertainer; // 追加
use Carbon\Carbon; //芸歴計算

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }


    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();


        // ユーザのtag一覧を作成日時の降順で取得
        $tags = $user->tags()->withPivot('tag_id')->orderBy('tag_id','asc')->get();

        $entertainers = array();
        foreach($tags as $tag){
            $entertainers[] = Entertainer::find($tag->pivot->entertainer_id);
        }


            // 誕生日同じ芸人
            $value = explode("-",$user->birthday); //誕生日を月と日で分割
            $month = $value[1];
            $day = $value[2];
            $birthday = Perfomer::whereMonth('birthday', '=', $month)->whereDay('birthday', '=', $day)->inRandomOrder()->first();        
       
        
            // 同郷芸人
            if(!empty($user->birthplace))
            $pref = Perfomer::where('birthplace', 'like',  '%'.$user->birthplace.'%')->inRandomOrder()->first();
            else
            $pref = null;
            //dd($pref);


            // 同い年芸人
            $now = new \Carbon\Carbon();
            $yearsOld = $now->diffInYears($user->birthday);//年齢
    
            $from = Carbon::now()->subYear($yearsOld)->format('Y-m-d');
            $to = Carbon::now()->subYear($yearsOld+1)->format('Y-m-d');    
    
            $age = Perfomer::inRandomOrder()->with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('active','desc')->first();
            //dd($age);


        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            //'youtubes' => $youtubes,
            'tags' => $tags,
            'entertainers' => $entertainers,            
            'now' => new \Carbon\Carbon(),            
            'birthday' => $birthday,            
            'pref' => $pref,            
            'age' => $age,                     
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
        $user = User::findOrFail($id);

        // 編集ビューでそれを表示
        return view('users.edit', [
            'user' => $user,
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
        $user = User::findOrFail($id);

        // メッセージを更新
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->birthplace = $request->birthplace;        

        $user->save();

        //dd($request->back_url);

        return back();        
    }
    
    

    
    
    




    public function tags($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザの投稿一覧を作成日時の降順で取得
        $tags = $user->tags()->withPivot('tag_id')->orderBy('tag_id','asc')->get();

        //$tags = $user->tags()->withPivot('tag_id')->orderBy('tag_id','asc')->get()->groupBy('name');        
        //$tags = $user->entertainers()->withPivot('tag_id')->get();              


//dd($user->tags()->with('entertainers')->get());
//dd($tags['好き'][1]->entertainers()->get());
//dd($tags[0]->entertainers());


        //$entertainers = array();
        $entertainers = [];
        
        foreach($tags as $tag){

            $entertainers[$tag->name][] = Entertainer::find($tag->pivot->entertainer_id);
        }
        
//dd($entertainers);

        // 誕生日同じ芸人
        $value = explode("-",$user->birthday); //誕生日を月と日で分割
        $month = $value[1];
        $day = $value[2];
        $birthday = Perfomer::whereMonth('birthday', '=', $month)->whereDay('birthday', '=', $day)->inRandomOrder()->first();        
        
        // 同郷芸人
        $pref = Perfomer::where('birthplace', 'like',  '%'.$user->birthplace.'%')->inRandomOrder()->first();
        //dd($pref);

        // 同い年芸人
        $now = new \Carbon\Carbon();
        $yearsOld = $now->diffInYears($user->birthday);//年齢

        $from = Carbon::now()->subYear($yearsOld)->format('Y-m-d');
        $to = Carbon::now()->subYear($yearsOld+1)->format('Y-m-d');    

        $age = Perfomer::inRandomOrder()->with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('active','desc')->first();



        // ユーザ詳細ビューでそれらを表示
        return view('users.tags', [
            'user' => $user,
            'tags' => $tags,
            'entertainers' => $entertainers,            
            'now' => new \Carbon\Carbon(), 
            'birthday' => $birthday,            
            'pref' => $pref,            
            'age' => $age,            
        ]);
    }    
    





    public function youtubes($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $youtubes = $user->youtubes()->orderBy('created_at', 'desc')->paginate(10);


//dd($youtubes);

        // 誕生日同じ芸人
        $value = explode("-",$user->birthday); //誕生日を月と日で分割
        $month = $value[1];
        $day = $value[2];
        $birthday = Perfomer::whereMonth('birthday', '=', $month)->whereDay('birthday', '=', $day)->inRandomOrder()->first();        
        
        // 同郷芸人
        $pref = Perfomer::where('birthplace', 'like',  '%'.$user->birthplace.'%')->inRandomOrder()->first();
        //dd($pref);

        // 同い年芸人
        $now = new \Carbon\Carbon();
        $yearsOld = $now->diffInYears($user->birthday);//年齢

        $from = Carbon::now()->subYear($yearsOld)->format('Y-m-d');
        $to = Carbon::now()->subYear($yearsOld+1)->format('Y-m-d');    

        $age = Perfomer::inRandomOrder()->with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('active','desc')->first();
        
        


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


        // ユーザ詳細ビューでそれらを表示
        return view('users.youtubes', [
            'user' => $user,
            'youtubes' => $youtubes,
            'birthday' => $birthday,            
            'pref' => $pref,            
            'age' => $age,            
            'iframe' => $iframe,            
        ]);
    }






    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $favorites = $user->favoritesyoutubes()->orderBy('created_at', 'desc')->paginate(10);



        // 誕生日同じ芸人
        $value = explode("-",$user->birthday); //誕生日を月と日で分割
        $month = $value[1];
        $day = $value[2];
        $birthday = Perfomer::whereMonth('birthday', '=', $month)->whereDay('birthday', '=', $day)->inRandomOrder()->first();        
        
        // 同郷芸人
        $pref = Perfomer::where('birthplace', 'like',  '%'.$user->birthplace.'%')->inRandomOrder()->first();
        //dd($pref);

        // 同い年芸人
        $now = new \Carbon\Carbon();
        $yearsOld = $now->diffInYears($user->birthday);//年齢

        $from = Carbon::now()->subYear($yearsOld)->format('Y-m-d');
        $to = Carbon::now()->subYear($yearsOld+1)->format('Y-m-d');    

        $age = Perfomer::inRandomOrder()->with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('active','desc')->first();




            $iflame = array();     //初期化     

            foreach($favorites as $value){
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



        // ユーザ詳細ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'favorites' => $favorites,
            'now' => new \Carbon\Carbon(),            
            'birthday' => $birthday,            
            'pref' => $pref,            
            'age' => $age,
            'iframe' => $iframe,
        ]);
    }
    
    

}

