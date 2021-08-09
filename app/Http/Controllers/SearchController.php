<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainer;
use App\Office; 
use App\Perfomer;
use App\Member;

use Carbon\Carbon; //芸歴計算


class SearchController extends Controller
{
    
    public function search(Request $request)
    {
        $query = Perfomer::with(['entertainer', 'office']);

        // 検索条件の値を取得
        $s_name = $request->input('s_name');
        $s_bloodtype = $request->input('s_bloodtype');
        $s_birthplace = $request->input('s_birthplace');
        //$s_start = $request->input('s_start'); 
        //$s_end = $request->input('s_end');         
        $s_ageStart = $request->input('s_ageStart'); 
        $s_ageEnd = $request->input('s_ageEnd');                 

        $from = Carbon::now()->subYear($s_ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($s_ageEnd)->format('Y-m-d');
        
        //dd($from);

        // もし$s_nameがあれば
        if(!empty($s_name)) {
            $query->where('name', 'like', '%'.$s_name.'%');
        }
        if(!empty($s_bloodtype)) {
            $query->where('bloodtype', 'like', '%'.$s_bloodtype.'%');
        }
        if(!empty($s_birthplace)) {
            $query->where('birthplace', 'like', '%'.$s_birthplace.'%');
        }
        //if(!empty($s_start)) {
        //    $query->whereBetween('birthday', [$to,$from]);
        //} 

        if(!empty($s_ageStart)) {
            $query->whereBetween('birthday', [$to,$from]);
        }

        $perfomers = $query->paginate(15);
       
        $now = new \Carbon\Carbon();
        $prefs = config('pref');
        $offices = Office::get(); 
        //dd($offices);

        return view('search', compact('perfomers','now','prefs'));

    }
    
    
}
