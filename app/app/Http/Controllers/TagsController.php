<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\User;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // メッセージ一覧を取得
        $tags = Tag::all();

        // メッセージ一覧ビューでそれを表示
        return view('tags.index', [
            'tags' => $tags,
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
        $tag = new Tag;

        // メッセージ作成ビューを表示
        return view('tags.create', [
            'tag' => $tag,
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
        
        
        // メッセージを作成
        $tag = new Tag;
        $tag->category = $request->category;
        $tag->name = $request->name;        
        $tag->save();

        // トップページへリダイレクトさせる
        return redirect('/admin/tags');

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
        $tag = Tag::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('tags.show', [
            'tag' => $tag,
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
        
        // idの値でメッセージを検索して取得
        $tag = Tag::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('tags.edit', [
            'tag' => $tag,
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
        $tag = Tag::findOrFail($id);
        // メッセージを更新
        $tag->category = $request->category;
        $tag->name = $request->name;        
        $tag->save();

        // トップページへリダイレクトさせる
        return redirect('/admin/tags');
    
        
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
        $tag = Tag::findOrFail($id);
        // メッセージを削除
        $tag->delete();

        // トップページへリダイレクトさせる
        return redirect('/admin/tags');
    }
    



    
}
