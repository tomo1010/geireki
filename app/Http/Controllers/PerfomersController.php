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
    public function index()
    {
        //一覧取得
        $perfomers = Perfomer::paginate(10);
        
        // 一覧ビューで表示
        return view('perfomers.index', [
            'perfomers' => $perfomers,
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
        $perfomer->official = $request->official;
        $perfomer->youtube = $request->youtube;
        $perfomer->entertainer_id = $request->entertainer_id;
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
        $perfomer = Perfomer::findOrFail($id);

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
        $perfomer->official = $request->official;
        $perfomer->youtube = $request->youtube;
        $perfomer->office_id = $request->office_id;
        $perfomer->save();

        // トップページへリダイレクトさせる
        //return redirect('/');
        return back();
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
dd($perfomer);

        // 編集ビューでそれを表示
        return view('perfomers.edit', [
            'perfomer' => $perfomer,
        ]);
    }

    
    
    
}
