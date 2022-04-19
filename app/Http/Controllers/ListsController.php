<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Member;
use App\Award;

use Carbon\Carbon; //芸歴計算


class ListsController extends Controller
{
    
  




    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function history()
    {
        
        // 芸歴別に人数をカウントし一覧表示
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
        
        // ビューで表示
        return view('lists.history', [
            'counts' => $counts,
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,        
            'now' => new \Carbon\Carbon(),
        ]);
        
    }
    
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function historyList($year)
    {
        
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');


        if($disband == '1'){
            //芸歴○年別で一覧表示
            $listyear = Carbon::now()->subYear($year); // 芸歴○年目を取得
            
            //$results_1 = Perfomer::whereYear('active','=', $listyear)->get();
            $results_1 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '1')->get();
            $results_2 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '2')->get();
            $results_3 = Entertainer::whereYear('active','=', $listyear)->where('numberofpeople','=', '3')->get();
            
            //$entertainers = Entertainer::sortable()->orderBy('active', 'desc')->paginate(5);
        }
        else{
            //芸歴○年別で一覧表示
            $listyear = Carbon::now()->subYear($year); // 芸歴○年目を取得
            
            //$results_1 = Perfomer::whereYear('active','=', $listyear)->get();
            $results_1 = Entertainer::where('activeend', NULL)->whereYear('active','=', $listyear)->where('numberofpeople','=', '1')->get();            
            $results_2 = Entertainer::where('activeend', NULL)->whereYear('active','=', $listyear)->where('numberofpeople','=', '2')->get();
            $results_3 = Entertainer::where('activeend', NULL)->whereYear('active','=', $listyear)->where('numberofpeople','=', '3')->get();
            
        }

        
        // 一覧ビューで表示
        return view('lists.historyList', [
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,
            'year' => $year,
            'plus' => $year+=1,
            'minus' => $year-=2,
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
        //navbarのプルダウンから受け取った年数をhistoryListControllerへ渡すだけの処理
        $year = $request->year;
        return redirect()->action('ListsController@historyList',['year' => $year]);
    }
    
    
    
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function office()
    {    
    
        //事務所別に人数を表示
        $office = Office::all();
        foreach($office as $value){
            $value->loadRelationshipCounts();  // 件数をロード
        }
    
        // ビューで表示
        return view('lists.office', [
            'office' => $office->sortByDesc('entertainers_count'),
        ]);
    
    }
    
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function officeList($id)
    {
        
        $office = Office::find($id);
        //dd($office);
        
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');


        if($disband == '1'){
            
            $results_1 = Entertainer::where('office_id','=', $id)->where('numberofpeople','=', '1')->orderBy('active','desc')->get();
            $results_2 = Entertainer::where('office_id','=', $id)->where('numberofpeople','=', '2')->orderBy('active','desc')->get();
            $results_3 = Entertainer::where('office_id','=', $id)->where('numberofpeople','=', '3')->orderBy('active','desc')->get();

        }
        else{

            $results_1 = Entertainer::where('office_id','=', $id)->where('activeend', NULL)->where('numberofpeople','=', '1')->orderBy('active','desc')->get();
            $results_2 = Entertainer::where('office_id','=', $id)->where('activeend', NULL)->where('numberofpeople','=', '2')->orderBy('active','desc')->get();
            $results_3 = Entertainer::where('office_id','=', $id)->where('activeend', NULL)->where('numberofpeople','=', '3')->orderBy('active','desc')->get();
            
        }


        
        // 一覧ビューで表示
        return view('lists.officeList', [
            'results_1' => $results_1,
            'results_2' => $results_2,
            'results_3' => $results_3,
            'office' => $office->office,
            'now' => new \Carbon\Carbon(),
        ]);
    }
    
 
 
 
 
 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function age()
    {

        $age = array();
        
        for($i = 1; $i < 8; $i++){
        $from = Carbon::now()->subYear($i*10)->format('Y-m-d');
        $to = Carbon::now()->subYear(($i*10)+10)->format('Y-m-d');
        $age[] = Perfomer::where([['birthday', '<=', $from],['birthday', '>', $to]],)->count();
        }


        // 一覧ビューで表示
        return view('lists.age', [
            'age' => $age,
        ]);
    }
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function ageList($year)
    {

        $year = $year *10;
        
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
  
  
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function age2List($yearsOld)
    {
        
        $from = Carbon::now()->subYear($yearsOld)->format('Y-m-d');
        $to = Carbon::now()->subYear($yearsOld+1)->format('Y-m-d');


        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){

            $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('birthday','desc')->paginate(15);

        }else{
            
            $perfomer = Perfomer::with(['entertainer.office'])->where('activeend', NULL)->where([['birthday', '<=', $from],['birthday', '>', $to]],)->orderBy('birthday','desc')->paginate(15);
        }
 

        
        // 一覧ビューで表示
        return view('lists.age2List', [
            'perfomer' => $perfomer,
            'yearsOld' => $yearsOld,
            'now' => new \Carbon\Carbon(),
        ]);
    }    
        
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function pref()
    {
        $prefs = config('pref');

        foreach($prefs as $pref){
            $prefCount[] = Perfomer::where('birthplace', 'like', '%'.$pref.'%')->count();
        }


        $touhoku = '0';
        for($i=1; $i<7; $i++){
        $touhoku += $prefCount[$i];
        }
        
        $kantou = '0';
        for($i=8; $i<14; $i++){
        $kantou += $prefCount[$i];
        }
        
        $hokuriku = '0';
        for($i=15; $i<20; $i++){
        $hokuriku += $prefCount[$i];
        }

        $toukai = '0';
        for($i=21; $i<24; $i++){
        $toukai += $prefCount[$i];
        }        
        
        $kansai = '0';
        for($i=25; $i<30; $i++){
        $kansai += $prefCount[$i];
        } 

        $chugoku = '0';
        for($i=31; $i<35; $i++){
        $chugoku += $prefCount[$i];
        } 

        $shikoku = '0';
        for($i=36; $i<39; $i++){
        $shikoku += $prefCount[$i];
        } 

        $kyuusyu = '0';
        for($i=40; $i<46; $i++){
        $kyuusyu += $prefCount[$i];
        }         


        return view('lists.pref', [
            'prefCount' => $prefCount,
            'prefs' => $prefs,
            
            'touhoku' => $touhoku,
            'kantou' => $kantou,
            'hokuriku' => $hokuriku,
            'toukai' => $toukai,
            'kansai' => $kansai,
            'chugoku' => $chugoku,
            'shikoku' => $shikoku,
            'kyuusyu' => $kyuusyu,
        ]);
        
    }
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function prefList($pref)
    {

        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');


        if($disband == '1'){
            
            $prefs = Perfomer::with(['entertainer.office'])->where('birthplace', 'like', '%'.$pref.'%')->orderBy('active', 'desc')->paginate(15);
        
        }
        else{
            
            $prefs = Perfomer::with(['entertainer.office'])->where('activeend', NULL)->where('birthplace', 'like', '%'.$pref.'%')->orderBy('active', 'desc')->paginate(15);
            
        }

        
        // 一覧ビューで表示
        return view('lists.prefList', [
            'perfomer' => $prefs,
            'pref' => $pref,            
            'now' => new \Carbon\Carbon(),            
        ]);
    }
    





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function award()
    {
     
         $awards = Award::with(['entertainer.office'])->orderBy('year', 'DESC')->paginate(15);
        
        // 受賞年ごとに人数をカウントし一覧表示
        $counts = array();
        $years = array();
        

        for($i=1950; $i<=2038; $i++){

            $years[] = $i;
            $counts[] = Award::where('year','=', $i)->count(); 
        }

        $m1_count = Award::where('award','like', '%'.'M-1グランプリ'.'%')->count();       
        $king_count = Award::where('award','like', '%'.'キングオブコント'.'%')->count();
        $kamigata_count = Award::where('award','like', '%'.'上方漫才大賞'.'%')->count();        
        
        // ビューで表示
        return view('lists.award', [
            'awards' => $awards,
            'now' => new \Carbon\Carbon(),            
            'years' => $years,    
            'counts' => $counts,
            
            'm1_count' => $m1_count,
            'king_count' => $king_count,
            'kamigata_count' => $kamigata_count,            
        ]);
        
    }
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function awardGp($gp)
    {

        $awards = Award::with(['entertainer.office'])->where('award','like', '%'.$gp.'%')->orderBy('year', 'DESC')->get();
        
        // ビューで表示

        return view('lists.awardGp', [
            'now' => new \Carbon\Carbon(),
            'awards' => $awards,
            'gp' => $gp, 
        ]);
        
    }






    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    public function awardList($year)
    {
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');
        
        
        if($disband == '1'){
            
            $awards = Award::with(['entertainer.office'])->where('year', '=', $year)->orderBy('year', 'DESC')->get();
        
        }
        else{

            $awards = Award::with(['entertainer.office'])->where('year', '=', $year)->orderBy('year', 'DESC')->get();
            
        }



        // ビューで表示
        return view('lists.awardList', [
            'awards' => $awards,    
            'year' => $year,                
            'now' => new \Carbon\Carbon(),

        ]);
        
        

    }
    
    
    


    
    
}