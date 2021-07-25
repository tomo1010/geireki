<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Member;

use Carbon\Carbon; //芸歴計算


class ListsController extends Controller
{
    
    public function all()
    {
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){
            // 一覧を取得
            $entertainers = Entertainer::sortable()->orderBy('active', 'desc')->paginate(15);
        }
        else{
            //解散済みを除いて取得
            $entertainers = Entertainer::where('activeend', NULL)->sortable()->orderBy('active', 'desc')->paginate(15);
        }
        
        
        // ビューで表示
        return view('lists.all', [
            'entertainers' => $entertainers,
            'now' => new \Carbon\Carbon(),
        ]);
        
    }
    
    
    
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
    
    
    
    
    
    
    
    
    
    
    
    public function office()
    {    
    
        //事務所別に人数を表示
        $office = Office::all();
        foreach($office as $value){
            $value->loadRelationshipCounts();  // 関係するモデルの件数をロード
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
            //'now' => new \Carbon\Carbon(),
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


        //10年単位で今日から○年前を取得
        $two = Carbon::now()->subYear(20)->format('Y-m-d'); //"2001-07-13"
        $three = Carbon::now()->subYear(30)->format('Y-m-d'); //"1971-07-17"
        $four = Carbon::now()->subYear(40)->format('Y-m-d');//"1931-07-17"
        $five = Carbon::now()->subYear(50)->format('Y-m-d'); 
        $six = Carbon::now()->subYear(60)->format('Y-m-d');
        $seven = Carbon::now()->subYear(70)->format('Y-m-d');
        $eight = Carbon::now()->subYear(80)->format('Y-m-d');


        $age = array();
        //perfomerテーブルから↑で範囲を指定して取得
        $age[] = Perfomer::where('birthday', '>', $two)->count();
        $age[] = Perfomer::where([['birthday', '<=', $two],['birthday', '>', $three]],)->count();        
        $age[] = Perfomer::where([['birthday', '<=', $three],['birthday', '>', $four]],)->count();
        $age[] = Perfomer::where([['birthday', '<=', $four],['birthday', '>', $five]],)->count();
        $age[] = Perfomer::where([['birthday', '<=', $five],['birthday', '>', $six]],)->count();                
        $age[] = Perfomer::where([['birthday', '<=', $seven],['birthday', '>', $eight]],)->count();                
        $age[] = Perfomer::where('birthday', '<=', $eight)->count();                        
        //dd($age);

        
        /*getパラメータから「解散済みを含めるか？」のチェックを受け取る        
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
            
        }*/


        
        // 一覧ビューで表示
        return view('lists.age', [

            'age' => $age,
            //'ten' => $ten,
            //'twenty' => $twenty,
            //'thirty' => $thirty,
            //'forty' => $forty,
            //'fifty' => $fifty,
            //'sixty' => $sixty,
            //'seventy' => $seventy,            
            //'now' => new \Carbon\Carbon(),
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


        //10年 単位で今日から○年前を取得
        $two = Carbon::now()->subYear(20)->format('Y-m-d'); //"2001-07-17"
        $three = Carbon::now()->subYear(30)->format('Y-m-d'); //"1971-07-17"
        $four = Carbon::now()->subYear(40)->format('Y-m-d');//"1931-07-17"
        $five = Carbon::now()->subYear(50)->format('Y-m-d'); 
        $six = Carbon::now()->subYear(60)->format('Y-m-d');
        $seven = Carbon::now()->subYear(70)->format('Y-m-d');
        $eight = Carbon::now()->subYear(80)->format('Y-m-d');


        //perfomerテーブルから↑で範囲を指定して取得
        if($year == '1'){
        $perfomer = Perfomer::with(['entertainer.office'])->where('birthday', '>', $two)->paginate(15);
        }
        elseif($year == '2'){
        $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $two],['birthday', '>', $three]],)->paginate(15);
        }
        elseif($year == '3'){
        $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $three],['birthday', '>', $four]],)->paginate(15);
        }
        elseif($year == '4'){
        $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $four],['birthday', '>', $five]],)->paginate(15);
        }
        elseif($year == '5'){
        $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $five],['birthday', '>', $six]],)->paginate(15);                
        }
        elseif($year == '6'){
        $perfomer = Perfomer::with(['entertainer.office'])->where([['birthday', '<=', $seven],['birthday', '>', $eight]],)->paginate(15);                
        }
        else
        $perfomer = Perfomer::with(['entertainer.office'])->where('birthday', '<=', $eight)->paginate(15);                        
        //dd($perfomer);
        

        
        /*getパラメータから「解散済みを含めるか？」のチェックを受け取る        
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
            
        }*/


        
        // 一覧ビューで表示
        return view('lists.ageList', [

            'perfomer' => $perfomer,
            'year' => $year,
            //'ten' => $ten,
            //'twenty' => $twenty,
            //'thirty' => $thirty,
            //'forty' => $forty,
            //'fifty' => $fifty,
            //'sixty' => $sixty,
            //'seventy' => $seventy,            
            'now' => new \Carbon\Carbon(),
        ]);
    }    
    
    
    
    
}