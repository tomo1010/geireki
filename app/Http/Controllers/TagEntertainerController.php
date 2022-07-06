<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;

class TagEntertainerController extends Controller
{
    
    /**
     * 芸人をtagするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {

        $entertainer_id = $request->entertainer_id;  //芸人idを取得
        $tag_id = $request->tag_id;  //タグidを取得        

        // 認証済みユーザが芸人のタグを作成
        \Auth::user()->entertainers()->attach($request->entertainer_id, ['tag_id' => $request->tag_id]);

        // 前のURLへリダイレクトさせる
        return back();
    }




    /**
     * 芸人のtagを解除するアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 芸人のtagを解除する
        \Auth::entertainer()->untagging($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
        
}
