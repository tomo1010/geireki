<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;

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
        $entertainer = new Entertainer;
        $entertainer->name = $request->name;
        $entertainer->realname = $request->realname;
        $entertainer->alias = $request->alias;
        $entertainer->birthday = $request->birthday;
        $entertainer->deth = $request->deth;
        $entertainer->birthplace = $request->birthplace;        
        $entertainer->bloodtype = $request->bloodtype;
        $entertainer->height = $request->height;
        $entertainer->dialect = $request->dialect;
        $entertainer->education = $request->education;
        $entertainer->master = $request->master;
        $entertainer->school = $request->school;        
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->entertainer_id = $request->entertainer_id;
        $entertainer->office_id = $request->office_id;
        $entertainer->save();

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
        $entertainer = Perfomer::find($id)->entertainer;
        //dd($entertainer);

        
        // メッセージ詳細ビューでそれを表示
        return view('perfomers.show', [
            'perfomer' => $perfomer,
            'office' => $office,
            'entertainer' => $entertainer,
            'now' => new \Carbon\Carbon(),
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
