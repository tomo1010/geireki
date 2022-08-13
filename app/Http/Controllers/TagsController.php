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
    


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tagRanking()
    {

        $tags = Tag::all(); //タグ情報を取得

        for($i = 1; $i < 30; $i++){ //$iはtagのidと連動し、viewへ渡す変数も[tagCounr_$id]と設定。tagづけされた芸人の上位10件をtagIdづつ取得
            $value = 'tagCount_'.$i;
            $$value = Entertainer::withCount(['tags' => function ($query) use ($i) { //芸人のタグごと上位10件取得
                    $query->where('tag_id', $i);
            }])->orderBy('tags_count', 'desc')->take(10)->get();
    
    }

//dd($tagCount_2);

    
    // ビューで表示
    return view('ranking.tag', [
        'tags' => $tags,
        'now' => new \Carbon\Carbon(),
        'tagCount_1' => $tagCount_1,
        'tagCount_2' => $tagCount_2,
        'tagCount_3' => $tagCount_3,
        'tagCount_4' => $tagCount_4,
        'tagCount_5' => $tagCount_5,
        'tagCount_6' => $tagCount_6,
        'tagCount_7' => $tagCount_7,
        'tagCount_8' => $tagCount_8,
        'tagCount_9' => $tagCount_9,
        'tagCount_10' => $tagCount_10,
        'tagCount_11' => $tagCount_11,
        'tagCount_12' => $tagCount_12,
        'tagCount_13' => $tagCount_13,
        'tagCount_14' => $tagCount_14,
        'tagCount_15' => $tagCount_15,
        'tagCount_16' => $tagCount_16,
        'tagCount_17' => $tagCount_17,
        'tagCount_18' => $tagCount_18,
        'tagCount_19' => $tagCount_19,
        'tagCount_20' => $tagCount_20,
        'tagCount_21' => $tagCount_21,
        'tagCount_22' => $tagCount_22,
        'tagCount_23' => $tagCount_23,
        'tagCount_24' => $tagCount_24,
        'tagCount_25' => $tagCount_25,
        'tagCount_26' => $tagCount_26,
        'tagCount_27' => $tagCount_27,
        'tagCount_28' => $tagCount_28,
        'tagCount_29' => $tagCount_29,
        
        ]);    

    }
    
    
}
