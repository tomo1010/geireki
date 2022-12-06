<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    /**
     * Youtbeをお気に入りするアクション。
     *
     * @param  $id  Youtubeのid
     * @return \Illuminate\Http\Response
     */
     
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをフォローする
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }


    /**
     *　Youtubeをお気に入りから外すアクション。
     *
     * @param  $id  youtubeのid
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
