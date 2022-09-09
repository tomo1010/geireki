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
use App\Favorite;

use Carbon\Carbon; //芸歴計算



class RankingController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        


    }     
    



    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    年の差コンビ
    */

    public function ageDiff()
    {

        $entertainers = Entertainer::withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->where('birthday','!=', NULL);
        })->get();  

        $results = array(); //比較結果を配列へ格納
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->birthday;
            $second = $entertainer->perfomers[1]->birthday;    
            $results[] = $first->diffInYears($second);
        }
        
        arsort($results);
        
        // 一覧ビューで表示
        return view('ranking.ageDiff', [
            'results' => $results,
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
    } 
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function heightTall()
    {

        $talls = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'desc')->paginate(10);

        
        // 一覧ビューで表示
        return view('ranking.heightTall', [
            'talls' => $talls,
        ]);
    }     




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function heightShort()
    {

        $shorts = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'asc')->paginate(10);

        
        // 一覧ビューで表示
        return view('ranking.heightShort', [
            'shorts' => $shorts,
        ]);
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    身長の差・凸凹コンビ
    */

    public function heightDiff()
    {
            
        $entertainers = Entertainer::with('perfomers')->withCount('perfomers')->having('perfomers_count', '=', 2)
                        ->where('activeend', NULL)->get(); 

        foreach($entertainers as $id => $entertainer){
        
             $first = $entertainer->perfomers[0]->height;
             $second = $entertainer->perfomers[1]->height;               

            if(!is_numeric($first) or !is_numeric($second)){ //heightにデータが無い場合を除く処理
                $entertainers->forget($id);
                continue;
            }
            
            if(abs($first-$second) >= 10){
                $entertainer->heightDiff = abs($first-$second); //差分の絶対値をプロパティへ格納
            }

        }

        $entertainers = $entertainers->sortByDesc('heightDiff');


    //     /*
    //     perfomerrから取得
    //     */
        
    //     $perfomers = Perfomer::with('entertainer')->whereNotNull('height')->where('height','!=','')
    //         ->whereHas('entertainer', function ($query) {
    //             $query->whereNumberofpeople('2');
    //             $query->whereNull('activeend');
    //         })->take(10)->get();


    //     $results = array(); //比較結果を配列へ格納

    //     foreach($perfomers as $perfomer){
        
    //         dd($perfomer->entertainer);
        
    //             $first = $entertainer->perfomers[0]->height;
    //             $second = $entertainer->perfomers[1]->height;                    
            
    //     //dd($first,$second);

    //         $results[] = abs($first-$second); //差分の絶対値を配列へ格納

    //     }

    // dd($results);
        
    //     arsort($results);
        
    //     //dd($results);        


        // 一覧ビューで表示
        return view('ranking.heightDiff', [
            //'results' => $results,
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
    } 
    
    
    



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    身長の合計・コンビ
    */

    public function heightSum()
    {

        /*
        entertainerから取得
        */

        $entertainers = Entertainer::with('perfomers')->withCount('perfomers')->having('perfomers_count', '=', 2)
                        ->where('activeend', NULL)->get(); 

        foreach($entertainers as $id => $entertainer){
        
            $first = $entertainer->perfomers[0]->height;
            $second = $entertainer->perfomers[1]->height;     
             
            if(!is_numeric($first) or !is_numeric($second)){
                $entertainers->forget($id);
                continue;
            }
            
            if(($first+$second) > 360){
                $entertainer->heightSum = $first + $second; //合計をプロパティへ格納
            }
        }

        $entertainers = $entertainers->sortByDesc('heightSum');

        // 一覧ビューで表示
        return view('ranking.heightSum', [
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
    } 
    



    /*
    若い時からから芸人スタート
    */

    public function ageYoung()
    {

        $perfomers = Perfomer::with(['entertainer'])->where('active', '!=' , '')->where('activeend', NULL)->where('birthday','!=', '')->get();  
        
        $young = array(); //比較結果を配列へ格納        

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $young[] = $birthday->diffInYears($active);
        }

        asort($young);        


        // 一覧ビューで表示
        return view('ranking.ageYoung', [
            'young' => $young,            
            'perfomers' => $perfomers,
            'now' => new \Carbon\Carbon(),
        ]);
    }    







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    年を取ってからから芸人スタート
    */

    public function ageElderly()    
    {

        $perfomers = Perfomer::with(['entertainer'])->where('active', '!=' , '')->where('activeend', NULL)->where('birthday','!=', '')->get();  

        $elderly = array(); //比較結果を配列へ格納

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $elderly[] = $birthday->diffInYears($active);
        }

        arsort($elderly);
        
        // 一覧ビューで表示
        return view('ranking.ageElderly', [
            'elderly' => $elderly,
            'perfomers' => $perfomers,
            'now' => new \Carbon\Carbon(),
        ]);
    }    
    




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function award()
    {

        //受賞数でランキング
        $awards = Entertainer::with(['award'])->get();

        $count = array();

        foreach($awards as $value){

            $count[] = $value->award->count();
        }
        
        arsort($count); //受賞数を降順で並べ替え
        
        // 一覧ビューで表示
        return view('ranking.award', [
            'awards' => $awards,
            'count' => $count,
        ]);
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function movieFavorite() //ネタ動画の「お気に入り件数」ランキング
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Youtube::with('entertainer')->withCount('favoritesUser')->orderBy('favorites_user_count', 'desc')->get();
        
        //Youtubeのサムネイルを取得
        // if (empty($count)) {
        //     //nullの場合何もしない
        //     $iflame = array();     //初期化
        //     $iframe[] = "-";
        // }else{

        
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


        // }
        
        // if (\Auth::check()) {
        //     $user = \Auth::user();  // 認証済みユーザを取得
        // } 




//dd($youtubes);
        
        // 一覧ビューで表示
        return view('ranking.movieFavorite', [
            'youtubes' => $youtubes,
            'iframe' => $iframe,            
            'now' => new \Carbon\Carbon(),
        ]);
    } 
    
    
    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function movieCount() //ネタ動画の「登録件数」ランキング
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Entertainer::withCount('youtubes')->orderBy('youtubes_count', 'desc')->take(10)->get();
        //dd($youtubes);
        
        // 一覧ビューで表示
        return view('ranking.movieCount', [
            'youtubes' => $youtubes,
        ]);
    } 
    
    





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    perfomerの2人の芸歴平均とentertainer芸歴の差分
    */

    public function historyAvg()
    {

        $entertainers = Entertainer::with('perfomers')->withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
            ->whereHas('perfomers', function ($query) {
                $query->whereNotNull('active')->where('active','!=','');
            })->get();

        $now = new \Carbon\Carbon();

        foreach($entertainers as $id => $entertainer){
        
            $first = $entertainer->perfomers[0]->active;
            $second = $entertainer->perfomers[1]->active;

            $first = $now->diffInYears($first);
            $second = $now->diffInYears($second);
             
            if(!is_numeric($first) or !is_numeric($second)){
                $entertainers->forget($id);
                continue;
            }

            if(empty($first) or empty($second)){
                $entertainers->forget($id);
                continue;
            }

            $entertainer->historyAvg = round(($first + $second)/2,1); //平均をプロパティへ格納            
            $entertainer->historyDiff = abs($now->diffInYears($entertainer->active) - $entertainer->historyAvg); //個人芸歴平均とコンビ芸歴の差分を格納　★★★

        }

        $entertainers = $entertainers->sortByDesc('historyDiff');

        // 一覧ビューで表示
        return view('ranking.historyAvg', [
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
    }    



    
}
