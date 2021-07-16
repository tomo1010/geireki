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
    
 
 
    
    
    public function age()
    {



        
        $today = Carbon::now(); //2021-07-13
        $two = $today->subYear(20)->format('Y-m-d'); //"2001-07-13"
        $three = $today->subYear(30)->format('Y-m-d'); //"1991-07-13"
        $four = $today->subYear(40)->format('Y-m-d');
        $five = $today->subYear(50)->format('Y-m-d'); 
        $six = $today->subYear(60)->format('Y-m-d');
        $seven = $today->subYear(70)->format('Y-m-d');
        $eight = $today->subYear(80)->format('Y-m-d');
        //dd($seventy);


        $perfomer = Perfomer::where('birthday', '!=', NULL)->where('birthday', '<=', $four)->where('birthday', '>', $five)->get();
        //dd($perfomer);


        $ten = Perfomer::where('birthday', '>', $two)->get();
        $twenty = Perfomer::where([['birthday', '<=', $two],['birthday', '>', $three]],)->get();        
        $thirty = Perfomer::where([['birthday', '<=', $three],['birthday', '>', $four]],)->get();
        //$forty = $perfomer->where('birthday', '>', $four)->get();
            //['birthday', '>', $five],
            //['birthday', '<=', $four],
            //])->get();
        $fifty = Perfomer::where([['birthday', '<=', $five],['birthday', '>', $six]],)->get();                
        $sixty = Perfomer::where([['birthday', '<=', $seven],['birthday', '>', $eight]],)->get();                
        $seventy = Perfomer::where('birthday', '<=', $eight)->get();                        
        dd($forty);


        
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
            //'results_1' => $results_1,
            //'results_2' => $results_2,
            //'results_3' => $results_3,
            'ten' => $ten,
            'twenty' => $twenty,
            'thirty' => $thirty,
            'forty' => $forty,
            'fifty' => $fifty,
            'sixty' => $sixty,
            'seventy' => $seventy,            
            'now' => new \Carbon\Carbon(),
        ]);
    }
    
    
    
    
    
    
}