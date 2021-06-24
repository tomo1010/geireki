<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Youtube;    // 追加
use App\User;    // 追加

class YoutubesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            $youtubes = $user->youtubes()->orderBy('created_at', 'desc')->paginate(10);
        } 
     
        // Youtube URL一覧を取得
        //$youtubes = Youtube::all();

        // Youtube URL一覧ビューでそれを表示
        return view('youtubes.index', [
            //'user' => $user,
            'youtubes' => $youtubes,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'youtube' => 'required|max:255',
            'time' => 'required|max:255',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->youtubes()->create([
            'youtube' => $request->youtube,
            'time' => $request->time,
            'entertainer_id' => $request->entertainer_id,
            
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // idの値で投稿を検索して取得
        $youtube = \App\Youtube::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $youtube->user_id) {
            $youtube->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
    }
}
