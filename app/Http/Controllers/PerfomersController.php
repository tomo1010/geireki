<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Member;

use Carbon\Carbon; //芸歴計算

class PerfomersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        //一覧取得
        // $perfomers = Perfomer::paginate(30);
        
        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){
            // 一覧を取得
            $perfomers = Perfomer::sortable()->orderBy('active', 'desc')->paginate(50);
        }
        else{
            //解散済みを除いて取得
            $perfomers = Perfomer::where('activeend', NULL)->sortable()->orderBy('active', 'desc')->paginate(50);
        }
        
        
        // 一覧ビューで表示
        return view('perfomers.all', [
            'perfomers' => $perfomers,
            'now' => new \Carbon\Carbon(),
        ]);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nsc()
    {
        //NSC出身だけど非吉本の芸人の一覧
        $nsc = Perfomer::whereHas('office',function($query){
            $query->where('id','!=','108');
            $query->where('id','!=','146');            
        })->where('school','like', '%NSC%')->take(10)->get();
        
        
        // 一覧ビューで表示
        return view('perfomers.nsc', [
            'nsc' => $nsc,
            'now' => new \Carbon\Carbon(),
        ]);
        
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfomer = new Perfomer;

        // 作成ビューを表示
        return view('perfomers.create', [
            'perfomer' => $perfomer,
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
            'office_id' => 'required|max:10',                
        ]);
        
        
        // 作成
        $perfomer = new Perfomer;
        $perfomer->name = $request->name;
        $perfomer->realname = $request->realname;
        $perfomer->alias = $request->alias;
        $perfomer->birthday = $request->birthday;
        $perfomer->deth = $request->deth;
        $perfomer->birthplace = $request->birthplace;        
        $perfomer->bloodtype = $request->bloodtype;
        $perfomer->height = $request->height;
        $perfomer->dialect = $request->dialect;
        $perfomer->educational = $request->educational;
        $perfomer->master = $request->master;
        $perfomer->school = $request->school;        
        $perfomer->active = $request->active;
        $perfomer->activeend = $request->activeend;
        $perfomer->spouse = $request->spouse;
        $perfomer->relatives = $request->relatives;
        $perfomer->disciple = $request->disciple;
        $perfomer->memo = $request->memo;        
        $perfomer->gag = $request->gag;                
        $perfomer->official = $request->official;
        $perfomer->twitter = $request->twitter;
        $perfomer->instagram = $request->instagram;
        $perfomer->facebook = $request->facebook;
        $perfomer->youtube = $request->youtube;
        $perfomer->tiktok = $request->tiktok;        
        $perfomer->blog = $request->blog;        
        $perfomer->office_id = $request->office_id;
        
        $perfomer->save();

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
        $perfomer = Perfomer::findOrFail($id);

        //所属事務所を取得
        $office = Perfomer::find($id)->office;

        //コンビ名を取得
        //$entertainer = Perfomer::find($id)->entertainer();

        // 活動開始年から芸歴を取得
        $active = $perfomer->active;

        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');


        /*
        関連芸人を取得　同期、1年先輩、1年後輩
        */
        
        if($disband == '1'){
        
            // 同期芸人を取得
            $sync = Perfomer::whereYear('active','=', $active)->where('id','!=',$id)->get();
    
            // 1年後輩を取得
            $year = new Carbon($active);
            $addYear = $year->addYear();
            $junior = Perfomer::whereYear('active','=', $addYear)->get();
    
            // 1年先輩を取得
            $year = new Carbon($active);
            $subYear = $year->subYear();
            $senior = Perfomer::whereYear('active','=', $subYear)->get();
        }
        
        else{
        
            // 同期芸人を取得
            $sync = Perfomer::where('activeend', NULL)->whereYear('active','=', $active)->where('id','!=',$id)->get();
    
            // 1年後輩を取得
            $year = new Carbon($active);
            $addYear = $year->addYear();
            $junior = Perfomer::where('activeend', NULL)->whereYear('active','=', $addYear)->get();
    
            // 1年先輩を取得
            $year = new Carbon($active);
            $subYear = $year->subYear();
            $senior = Perfomer::where('activeend', NULL)->whereYear('active','=', $subYear)->get();            
        }



        
        // メッセージ詳細ビューでそれを表示
        return view('perfomers.show', [
            'perfomer' => $perfomer,
            'office' => $office,
            //'entertainer' => $entertainer,
            'now' => new \Carbon\Carbon(),
            'sync' => $sync,
            'junior' => $junior,
            'senior' => $senior,
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
        $perfomer = Perfomer::with('entertainer')->findOrFail($id);

        // 編集ビューでそれを表示
        return view('perfomers.edit', [
            'perfomer' => $perfomer,
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
        $perfomer = Perfomer::findOrFail($id);
        // メッセージを更新
        $perfomer->name = $request->name;
        $perfomer->realname = $request->realname;
        $perfomer->alias = $request->alias;
        $perfomer->birthday = $request->birthday;
        $perfomer->deth = $request->deth;
        $perfomer->birthplace = $request->birthplace;        
        $perfomer->bloodtype = $request->bloodtype;
        $perfomer->height = $request->height;
        $perfomer->dialect = $request->dialect;
        $perfomer->educational = $request->educational;
        $perfomer->master = $request->master;
        $perfomer->school = $request->school;        
        $perfomer->active = $request->active;
        $perfomer->activeend = $request->activeend;
        $perfomer->spouse = $request->spouse;
        $perfomer->relatives = $request->relatives;
        $perfomer->disciple = $request->disciple;        
        $perfomer->memo = $request->memo;
        $perfomer->gag = $request->gag;        
        $perfomer->official = $request->official;

        $perfomer->twitter = $request->twitter;        
        $perfomer->instagram = $request->instagram;        
        $perfomer->facebook = $request->facebook;        
        $perfomer->youtube = $request->youtube;        
        $perfomer->tiktok = $request->tiktok;                
        $perfomer->blog = $request->blog;        

        // $perfomer->entertainer_id = $request->entertainer_id;        
        $perfomer->office_id = $request->office_id;

        $perfomer->save();

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
        $perfomer = Perfomer::findOrFail($id);
        // メッセージを削除
        $perfomer->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function age($year)
    {
        // yearの値で検索して取得
        $perfomer = Perfomer::whereBetween('office_id', [$year])->get();

        // 編集ビューでそれを表示
        return view('perfomers.edit', [
            'perfomer' => $perfomer,
        ]);
    }

    
    

   
   
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hinaGacha(Request $request)
    {

        
        /*ひな壇ガチャ
        */
    
    
        $query = Perfomer::with(['entertainer', 'office'])->where('active', '!=' ,NULL)->where('activeend', NULL)->where('birthday', '!=' ,NULL)->orderByRaw('active desc, name desc');
        $query_2 = Perfomer::with(['entertainer', 'office'])->where('active', '!=' ,NULL)->where('activeend', NULL)->where('birthday', '!=' ,NULL)->orderByRaw('active desc, name desc');        
        


//一人目
        //芸歴
        $start = $request->input('start'); 
            if($start == null){
                $start = 1;
            }
            
        $end = $request->input('end');                
            if($end == null){
                $end = 100;
            }

        
        
        //年代
        $age = $request->input('age'); 
        

            if($age == null){
                $ageStart = 1;
                $ageEnd = 99;
            }    
            elseif($age == '10b'){
                $ageStart = 1;
                $ageEnd = 19;                
            }    
            elseif($age == '20a'){
                $ageStart = 20;
                $ageEnd = 24;
            }
            elseif($age == '20b'){
                $ageStart = 25;
                $ageEnd = 29;
            }
            elseif($age == '30a'){
                $ageStart = 30;
                $ageEnd = 34;
            }
            elseif($age == '30b'){
                $ageStart = 35;
                $ageEnd = 39;
            }
            elseif($age == '40a'){
                $ageStart = 40;
                $ageEnd = 44;
            }
            elseif($age == '40b'){
                $ageStart = 45;
                $ageEnd = 49;
            }            
            elseif($age == '50a'){
                $ageStart = 50;
                $ageEnd = 54;
            }
            elseif($age == '50b'){
                $ageStart = 55;
                $ageEnd = 59;
            }
            elseif($age == '60a'){
                $ageStart = 60;
                $ageEnd = 64;
            }            
            elseif($age == '60b'){
                $ageStart = 65;
                $ageEnd = 69;
            }
            elseif($age == '70a'){
                $ageStart = 70;
                $ageEnd = 74;
            }
            elseif($age == '70b'){
                $ageStart = 75;
                $ageEnd = 79;
            }            
            elseif($age == '80a'){
                $ageStart = 80;
                $ageEnd = 84;
            }
            elseif($age == '80b'){
                $ageStart = 85;
                $ageEnd = 89;
            }
            elseif($age == '90a'){
                $ageStart = 90;
                $ageEnd = 94;
            }
            elseif($age == '90b'){
                $ageStart = 95;
                $ageEnd = 99;
            }
        //dd($ageStart,$ageEnd);              
        
        
        /*日付フォーマットへ変換
        */
        
        //芸歴
        $start = Carbon::now()->subYear($start)->format('Y-m-d'); //"2011-08-14"
        $end = Carbon::now()->subYear($end)->format('Y-m-d'); //"2001-08-14"
        
        //年代
        $from = Carbon::now()->subYear($ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($ageEnd)->format('Y-m-d');        
        
        
        
        
        /*検索クエリー作成
        */
        
        //芸歴
        if(!empty($start) && !empty($end) && $start != $end) { //startとendが空じゃない場合は、startからendまで
            $query->whereBetween('active', [$end,$start]);
        }    
        elseif(!empty($start) && !empty($end) && $start == $end){ //startとendが空じゃななく、startとendが同じ場合
            $query->whereYear('active', '=' ,$start);
        }
        elseif(!empty($start) && empty($end)){ //startのみ選択でendが空の場合
            $query->where('active', '<=' ,$start);
        }
        elseif(empty($start) && !empty($end)){ //startが空でendのみ選択の場合
            $query->where('active', '>=' ,$end);
        }
   
  
   
   

        //年齢
        if(!empty($ageStart) && !empty($ageEnd) && $ageStart != $ageEnd) {
            $query->whereBetween('birthday', [$to,$from]);
        }
        elseif(!empty($ageStart) && !empty($ageEnd) && $ageStart == $ageEnd){
            $ageStart = $request->input('ageStart')+1; 
            $ageEnd = $request->input('ageEnd')+1;                
            $from = Carbon::now()->subYear($ageStart)->format('Y-m-d');
            $to = Carbon::now()->subYear($ageEnd)->modify('+1 year')->format('Y-m-d');
            $query->whereBetween('birthday', [$from,$to]);
        }
        elseif(!empty($ageStart) && empty($ageEnd)){
            $query->where('birthday', '<=' ,$from);
        }
        elseif(empty($ageStart) && !empty($ageEnd)){
            $query->where('birthday', '>=' ,$to);
        }



        //コンビ    
            $query->whereHas('entertainer', function ($que) {
                $que->where('numberofpeople', '=', 2);
            });








//2人目
        //芸歴
        $start = $request->input('start_2'); 
            if($start == null){
                $start = 1;
            }
            
        $end = $request->input('end_2');                
            if($end == null){
                $end = 100;
            }

        
        
        //年代
        $age = $request->input('age_2'); 
        

            if($age == null){
                $ageStart = 1;
                $ageEnd = 99;
            }    
            elseif($age == '10b'){
                $ageStart = 1;
                $ageEnd = 19;                
            }    
            elseif($age == '20a'){
                $ageStart = 20;
                $ageEnd = 24;
            }
            elseif($age == '20b'){
                $ageStart = 25;
                $ageEnd = 29;
            }
            elseif($age == '30a'){
                $ageStart = 30;
                $ageEnd = 34;
            }
            elseif($age == '30b'){
                $ageStart = 35;
                $ageEnd = 39;
            }
            elseif($age == '40a'){
                $ageStart = 40;
                $ageEnd = 44;
            }
            elseif($age == '40b'){
                $ageStart = 45;
                $ageEnd = 49;
            }            
            elseif($age == '50a'){
                $ageStart = 50;
                $ageEnd = 54;
            }
            elseif($age == '50b'){
                $ageStart = 55;
                $ageEnd = 59;
            }
            elseif($age == '60a'){
                $ageStart = 60;
                $ageEnd = 64;
            }            
            elseif($age == '60b'){
                $ageStart = 65;
                $ageEnd = 69;
            }
            elseif($age == '70a'){
                $ageStart = 70;
                $ageEnd = 74;
            }
            elseif($age == '70b'){
                $ageStart = 75;
                $ageEnd = 79;
            }            
            elseif($age == '80a'){
                $ageStart = 80;
                $ageEnd = 84;
            }
            elseif($age == '80b'){
                $ageStart = 85;
                $ageEnd = 89;
            }
            elseif($age == '90a'){
                $ageStart = 90;
                $ageEnd = 94;
            }
            elseif($age == '90b'){
                $ageStart = 95;
                $ageEnd = 99;
            }
        //dd($ageStart,$ageEnd);              
        
        
        /*日付フォーマットへ変換
        */
        
        //芸歴
        $start = Carbon::now()->subYear($start)->format('Y-m-d'); //"2011-08-14"
        $end = Carbon::now()->subYear($end)->format('Y-m-d'); //"2001-08-14"
        
        //年代
        $from = Carbon::now()->subYear($ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($ageEnd)->format('Y-m-d');        
        
        
        
        
        /*検索クエリー作成
        */
        
        //芸歴
        if(!empty($start) && !empty($end) && $start != $end) { //startとendが空じゃない場合は、startからendまで
            $query_2->whereBetween('active', [$end,$start]);
        }    
        elseif(!empty($start) && !empty($end) && $start == $end){ //startとendが空じゃななく、startとendが同じ場合
            $query_2->whereYear('active', '=' ,$start);
        }
        elseif(!empty($start) && empty($end)){ //startのみ選択でendが空の場合
            $query_2->where('active', '<=' ,$start);
        }
        elseif(empty($start) && !empty($end)){ //startが空でendのみ選択の場合
            $query_2->where('active', '>=' ,$end);
        }
   
  
   
   

        //年齢
        if(!empty($ageStart) && !empty($ageEnd) && $ageStart != $ageEnd) {
            $query_2->whereBetween('birthday', [$to,$from]);
        }
        elseif(!empty($ageStart) && !empty($ageEnd) && $ageStart == $ageEnd){
            $ageStart = $request->input('ageStart')+1; 
            $ageEnd = $request->input('ageEnd')+1;                
            $from = Carbon::now()->subYear($ageStart)->format('Y-m-d');
            $to = Carbon::now()->subYear($ageEnd)->modify('+1 year')->format('Y-m-d');
            $query_2->whereBetween('birthday', [$from,$to]);
        }
        elseif(!empty($ageStart) && empty($ageEnd)){
            $query_2->where('birthday', '<=' ,$from);
        }
        elseif(empty($ageStart) && !empty($ageEnd)){
            $query_2->where('birthday', '>=' ,$to);
        }



        //コンビ    
            $query_2->whereHas('entertainer', function ($que) {
                $que->where('numberofpeople', '=', 2);
            });


        $perfomers = $query->get();
        //dd($perfomers);
        
        if($perfomers->isEmpty()){
            $perfomers = null;
        }else{
            $perfomers = $perfomers->random(1)->first();                    
        }



        $perfomers_2 = $query_2->get();
        
        if($perfomers_2->isEmpty()){
            $perfomers_2= null;
        }else{
            $perfomers_2 = $perfomers_2->random(1)->first();    
        }

        
        /*一覧ビューで表示
        */
        return view('perfomers.hinaGacha', [
        'hinaGacha' => $perfomers,        
        'hinaGacha_2' => $perfomers_2,
        'now' => new \Carbon\Carbon(),
    ]);

    }
    
    
    

    
    
}
