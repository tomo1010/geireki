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
        // 一覧ビューで表示
        return view('ranking.index'); 
    }     
    



    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*
    年の差コンビ
    */

    public function yearDiff()
    {

        $entertainers = Entertainer::withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->where('birthday','!=', NULL);
        })->get();  

//dd($entertainers);
//dd($entertainers[0]->perfomers[0]);
//dd($entertainers[1]->perfomers[1]);

        $results = array(); //比較結果を配列へ格納
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->birthday;
            $second = $entertainer->perfomers[1]->birthday;    
            $results[] = $first->diffInYears($second);
        }
        
        arsort($results);

//dd($results);


        // 一覧ビューで表示
        return view('ranking.yearDiff', [
            'results' => $results,
            'entertainers' => $entertainers,
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





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function tall()
    {

        //おすすめネタ動画　Youtube動画一覧
        $talls = Perfomer::with(['entertainer'])->where('height', '!=', '')->orderBy('height', 'desc')->paginate(15);

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

        //
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


    /*
    身長の差コンビ
    */

    public function heightDiff()
    {

        $entertainers = Entertainer::with(['perfomers.office'])->where('numberofpeople', '=','2')->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->where('height','!=', NULL);
        })->take(10)->get();  


//dd($entertainers[0]->perfomers[0]);
//dd($entertainers[0]->perfomers[1]);


        $result = array();
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->height;
            $second = $entertainer->perfomers[1]->height;    
        
            $result = abs($first - $second);
            dd($result);
        }
        
        //  foreach($result as $value){
        //      dd($value);
        //  }
        
        
        
        dd($result[]);




        $from = Carbon::now()->subYear($year)->format('Y-m-d');
        $to = Carbon::now()->subYear($year+10)->format('Y-m-d');





        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){

            $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('birthday','desc')->paginate(15);

        }else{
            
            $perfomer = Perfomer::with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('birthday','desc')->paginate(15);
        }
 

        
        // 一覧ビューで表示
        return view('lists.ageList', [
            'perfomer' => $perfomer,
            'year' => $year,
            'now' => new \Carbon\Carbon(),
        ]);
    } 





    
    
}
