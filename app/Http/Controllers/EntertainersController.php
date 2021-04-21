<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use Carbon\Carbon;

class EntertainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 一覧を取得
        $entertainers = Entertainer::all();
        
        $active = Entertainer::select('active')->get();
        $today = new Carbon();
        $diff = array();
    
        
        foreach($active as $value){
            $value = $value->active;
            $value = new Carbon($value);
            $diff[] = $value->diffInYears($today);
        }

            //dd($diff);
        
        // 一覧ビューでそれを表示
        return view('entertainers.index', [
            'entertainers' => $entertainers,
            'diff' => $diff,
        ]);
        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entertainer = new Entertainer;

        // 作成ビューを表示
        return view('entertainers.create', [
            'entertainer' => $entertainer,
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
        $entertainer->validate([
            'name' => 'required|max:255',
            'numberofpeople' => 'required|max:255',
            'alias' => 'required|max:255',
            'active' => 'required|max:255',
            'activeend' => 'required|max:255',
            'master' => 'required|max:255',
            'oldname' => 'required|max:255',
            'official' => 'required|max:255',
            'youtube' => 'required|max:255',
        ]);
        

        // 作成
        $entertainer = new Entertainer;
        $entertainer->name = $request->name;
        $entertainer->numberofpeople = $request->numberofpeople;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
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
        $entertainer = Entertainer::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('entertainers.show', [
            'entertainer' => $entertainer,
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
        $entertainer = Entertainer::findOrFail($id);

        // 編集ビューでそれを表示
        return view('entertainers.edit', [
            'entertainer' => $entertainer,
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
        $entertainer = Entertainer::findOrFail($id);
        // メッセージを更新
        $entertainer->name = $request->name;
        $entertainer->numberofpeople = $request->numberofpeople;
        $entertainer->alias = $request->alias;
        $entertainer->active = $request->active;
        $entertainer->activeend = $request->activeend;
        $entertainer->master = $request->master;
        $entertainer->oldname = $request->oldname;
        $entertainer->official = $request->official;
        $entertainer->youtube = $request->youtube;
        $entertainer->save();

        // トップページへリダイレクトさせる
        return redirect('/');
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
        $entertainer = Entertainer::findOrFail($id);
        // メッセージを削除
        $entertainer->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
