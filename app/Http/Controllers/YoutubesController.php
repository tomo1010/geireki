<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Youtube;    // 追加
use App\User;    // 追加
use App\Entertainer;    // 追加

class YoutubesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();  // 認証済みユーザを取得
            //$youtubes = $user->youtubes()->orderBy('created_at', 'desc')->paginate(10);
            $youtubes = $user->youtubes()->with(['entertainer'])->orderBy('created_at', 'desc')->paginate(10);
        } 
     
        // Youtube URL一覧ビューでそれを表示
        return view('youtubes.youtubes', [
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
            'youtube' => 'required|max:255|starts_with:https://youtu.be/|unique:youtubes,youtube',
            'comment' => 'required|max:50',
        ]);
        

//dd($request);

        //URL件数の制限   
        $id = $request->entertainer_id;

        $user = \Auth::user();  // 認証済みユーザを取得
        $counts = $user->youtubes()->where('entertainer_id', $id)->count();

        // $counts = $user->youtubes()->with(['entertainer'])->count();
        
        if($counts >= 3){
            return back()->with('message', 'おすすめネタ動画は1芸人につき3件までとなります');
        }

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->youtubes()->create([
            'youtube' => $request->youtube,
            'comment' => $request->comment,
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
