<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Youtube;
use App\Member;
use App\Award;
use App\User;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $member = new Member;

        // 作成ビューを表示
        return view('members.create', [
            'member' => $member,
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
        $member = new Member;
        $member->entertainer_id = $request->entertainer_id;        
        $member->perfomer_id = $request->perfomer_id;                
        $member->save();

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
        // idの値で検索して取得
        $member = Member::where('entertainer_id', $id)->first();

        // 編集ビューでそれを表示
        return view('members.edit', [
            'member' => $member,
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
