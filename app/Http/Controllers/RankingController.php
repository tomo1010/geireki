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

        $young = array(); //比較結果を配列へ格納　※若い時から芸人

        foreach($perfomers as $perfomer){
            $birthday = $perfomer->birthday;
            $active = $perfomer->active;    
            $young[] = $birthday->diffInYears($active);
        }

        arsort($young);


        $elderly = array(); //比較結果を配列へ格納　※年をとってから芸人

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
    身長の差・コンビ
    */

    public function heightDiff()
    {


        /*
        entertainerから取得
        */

        $entertainers = Entertainer::with('perfomers')->withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
            ->whereHas('perfomers', function ($query) {
                $query->whereNotNull('height')->where('height','!=','');
            })->get(); 

        //dd($entertainers[25]);

        //$results = array(); //比較結果を配列へ格納

        foreach($entertainers as $id => $entertainer){
        
             $first = $entertainer->perfomers[0]->height;
             $second = $entertainer->perfomers[1]->height;               

            if(!is_numeric($first) or !is_numeric($second)){
                $entertainers->forget($id);
                continue;
            }
            
            if(abs($first-$second) >= 10){
            
                $entertainer->diff = abs($first-$second); //差分の絶対値を配列へ格納
                
            }

        }

        //dd($entertainers);


        $entertainers = $entertainers->sortByDesc('diff');

        //dd($entertainers);

        
        
        
        

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

        $entertainers = Entertainer::withCount('perfomers')->having('perfomers_count', '=', 2)->where('activeend', NULL)
        ->whereHas('perfomers', function ($query) {
            $query->whereNotNull('height');
            $query->where('height','!=','');
            $query->whereNotIn('height','');
        })->take(8)->get();  
        


        $results = array(); //比較結果を配列へ格納

//dd($entertainers);
        
        foreach($entertainers as $entertainer){
        
            $first = $entertainer->perfomers[0]->height;
            $second = $entertainer->perfomers[1]->height;    

//dd($first,$second);

            $results[] = abs($first+$second);

        }

dd($results);
        
        arsort($results);
        
//dd($results);        
        
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
     
    public function favorite() //ネタ動画の「お気に入り件数」ランキング
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Favorite::withCount('user')->orderBy('user_count', 'desc')->get();
        
        // 関係するモデルの件数をロード
        // $youtubes = Youtube::all();
        // $youtubes->loadRelationshipCounts();        

dd($youtubes);
        
        // 一覧ビューで表示
        return view('ranking.favorite', [
            'youtubes' => $youtubes,
            'now' => new \Carbon\Carbon(),
        ]);
    } 
    
    
    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function youtubeCount() //ネタ動画の「登録件数」ランキング
    {

        //おすすめネタ動画　Youtube動画一覧
        $youtubes = Entertainer::withCount('youtubes')->orderBy('youtubes_count', 'desc')->take(10)->get();
        //dd($youtubes);
        
        // 一覧ビューで表示
        return view('ranking.youtubecount', [
            'youtubes' => $youtubes,
        ]);
    } 



    
}
