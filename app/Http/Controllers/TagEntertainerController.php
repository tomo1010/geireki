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
        // 認証済みユーザ（閲覧者）が、表示している芸人をタグする
        \Auth::user()->tagging($request);
        // 前のURLへリダイレクトさせる
        return back();
    }




    /**
     * 芸人のtagを解除するアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     
    public function destroy(Request $request)
    {
//dd($request);
        // 認証済みユーザ（閲覧者）が、 芸人のtagを解除する
        \Auth::user()->untagging($request);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    
    
    
    
    
    
    
    
    
        
}
