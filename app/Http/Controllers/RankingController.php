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



class RankingController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        

        //年齢差ランキング
        
        $entertainers = Entertainer::withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->where('birthday','!=', NULL);
        })->get();  

        $results = array(); //比較結果を配列へ
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->birthday;
            $second = $entertainer->perfomers[1]->birthday;    
            $results[] = $first->diffInYears($second);
        }
        
        arsort($results);


        //芸歴差ランキング

        $perfomers = Perfomer::with(['entertainer'])->where('active', '!=' , NULL)->where('activeend', NULL)->where('birthday','!=', NULL)->get();  

        $young = array(); //比較結果を配列へ格納

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $young[] = $birthday->diffInYears($active);
        }

        arsort($young);


        $elderly = array(); //比較結果を配列へ格納        

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $elderly[] = $birthday->diffInYears($active);
        }

        asort($elderly);


        //身長が低いランキング

        $shorts = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'asc')->paginate(10);
        

        //身長が高いランキング        

        $talls = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'desc')->paginate(10);


        // 一覧ビューで表示
        return view('ranking.index', [
            'results' => $results,
            'entertainers' => $entertainers,

            'young' => $young,
            'elderly' => $elderly,            
            'perfomers' => $perfomers,

            'now' => new \Carbon\Carbon(),

            'shorts' => $shorts,
            'talls' => $talls,            

        ]);
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
     
    public function tall()
    {

        $talls = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'desc')->paginate(10);

//dd($talls);
        
        // 一覧ビューで表示
        return view('ranking.tall', [
            'talls' => $talls,
        ]);
    }     




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function short()
    {

        $shorts = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'asc')->paginate(10);

        
        // 一覧ビューで表示
        return view('ranking.short', [
            'shorts' => $shorts,
        ]);
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    身長の差コンビ
    */

    public function heightDiff()
    {

        $entertainers = Entertainer::withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->where('height','!=', '');
        })->take(12)->get();  

        $results = array(); //比較結果を配列へ格納

dd($entertainers);
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->height;
            $first = str_replace('cm', '', $first);
            $first = trim($first);

            $second = $entertainer->perfomers[1]->height;    
            $second = str_replace('cm', '', $second);
            $second = trim($second);

//dd($first,$second);

            $results[] = abs($first-$second);

        }

//dd($results);        
        
        arsort($results);
        
dd($results);        
        
        // 一覧ビューで表示
        return view('ranking.heightDiff', [
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


    /*
    年齢と芸歴の差分
    */

    public function yearDiff()
    {

        $perfomers = Perfomer::with(['entertainer'])->where('active', '!=' , '')->where('activeend', NULL)->where('birthday','!=', '')->get();  
        
//dd($);

        $young = array(); //比較結果を配列へ格納

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $young[] = $birthday->diffInYears($active);
        }

        arsort($young);
        
//dd($young);        


        $elderly = array(); //比較結果を配列へ格納        

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $elderly[] = $birthday->diffInYears($active);
        }

        asort($elderly);        

//dd($perfomers[1]->entertainer[0]->name);

//dd($elderly);
        
        // 一覧ビューで表示
        return view('ranking.yearDiff', [
            'young' => $young,
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
        $awards = Entertainer::with(['award'])->take(10)->paginate(15);
//dd($awards[0]);
        $count = array();

        foreach($awards as $value){
            //dd($award->award->count());
            $count[] = $value->award->count();
        }
        
        arsort($count); //受賞数を降順で並べ替え

//dd($count);
        
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
     
    public function favorite()
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Youtube::with(['user'])->get();
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
            
                $iframe[] = "http://img.youtube.com/vi/{$code}/2.jpg";
            }            
        }


//dd($youtubes);

        
        // 一覧ビューで表示
        return view('ranking.favorite', [
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
     
    public function youtubeCount()
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Entertainer::with(['youtubes'])->find(5);
        $youtubes = $youtubes->youtubes[0]->youtube;
        //$count = $youtubes->loadRelationshipCounts();                

//dd($count);
//dd($youtubes);

        //Youtube動画をカウント
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
            
                $iframe[] = "http://img.youtube.com/vi/{$code}/2.jpg";
            }            
        }


//dd($youtubes);

        
        // 一覧ビューで表示
        return view('ranking.favorite', [
            'youtubes' => $youtubes,
            'iframe' => $iframe,  
            'now' => new \Carbon\Carbon(),
        ]);
    } 



    
}
