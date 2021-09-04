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

        $s_start = $request->input('s_start'); 
        $s_end = $request->input('s_end');         

        $s_ageStart = $request->input('s_ageStart'); 
        $s_ageEnd = $request->input('s_ageEnd');        

        $s_month = $request->input('s_month'); 
        $s_day = $request->input('s_day');                
        
        $s_numberofpeople = $request->input('numberofpeople');
        
        $s_etc = $request->input('etc');        

        $start = Carbon::now()->subYear($s_start)->format('Y-m-d'); //"2011-08-14"
        $end = Carbon::now()->subYear($s_end)->format('Y-m-d'); //"2001-08-14"
        $from = Carbon::now()->subYear($s_ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($s_ageEnd)->format('Y-m-d');
        
        //dd($s_pin);


        //芸歴検索
        if(!empty($s_start) && !empty($s_end) && $s_start != $s_end) {
            $query->whereBetween('active', [$end,$start]);
        }    
        elseif(!empty($s_start) && !empty($s_end) && $s_start == $s_end){
            $query->whereYear('active', '=' ,$start);
        }
        elseif(!empty($s_start) && empty($s_end)){
            $query->where('active', '<=' ,$start);
        }
        elseif(empty($s_start) && !empty($s_end)){
            $query->where('active', '>=' ,$end);
        }


        //年齢検索
        if(!empty($s_ageStart) && !empty($s_ageEnd) && $s_ageStart != $s_ageEnd) {
            $query->whereBetween('birthday', [$to,$from]);
        }
        elseif(!empty($s_ageStart) && !empty($s_ageEnd) && $s_ageStart == $s_ageEnd){
            $s_ageStart = $request->input('s_ageStart')+1; 
            $s_ageEnd = $request->input('s_ageEnd')+1;                
            $from = Carbon::now()->subYear($s_ageStart)->format('Y-m-d');
            $to = Carbon::now()->subYear($s_ageEnd)->modify('+1 year')->format('Y-m-d');
            $query->whereBetween('birthday', [$from,$to]);
        }
        elseif(!empty($s_ageStart) && empty($s_ageEnd)){
            $query->where('birthday', '<=' ,$from);
        }
        elseif(empty($s_ageStart) && !empty($s_ageEnd)){
            $query->where('birthday', '>=' ,$to);
        }


        //名前、血液型、出身地検索
        if(!empty($s_name)) {
            $query->where('name', 'like', '%'.$s_name.'%');
        }
        if(!empty($s_bloodtype)) {
            $query->where('bloodtype', 'like', '%'.$s_bloodtype.'%');
        }
        if(!empty($s_birthplace)) {
            $query->where('birthplace', 'like', '%'.$s_birthplace.'%');
        }
        

        //誕生日検索
        if(!empty($s_month)) {
            $query->whereMonth('birthday', $s_month);
        }
        if(!empty($s_day)) {
            $query->whereDay('birthday', $s_day);
        }        


//dd($request->numberofpeople);
//dd($s_numberofpeople);
                    
                    
        //ピン、コンビ、トリオの条件指定        
        if(!empty($s_numberofpeople)) {
            $i = 0;
            foreach($s_numberofpeople as $value){
                dd($value);
                $query->whereHas('entertainer', function ($que) use ($value,$i) {
                    if (empty($i)) {
                        $where = 'where';
                    }
                    else{
                        $where = 'orWhere';
                    }
                    $que->$where('numberofpeople', '=', $value);
                    $i++;
                //dd($i);    
                });
            }   
        }



        //その他の条件指定        
        if(!empty($s_etc)) {
                $query->whereHas('entertainer.award', function ($que) use ($s_etc) {
                    $que->Where('award', 'like', '%'.$s_etc.'%');
                    });
        }



                //$where = ($i==0) ? 'where' : 'orWhere';

        // //ピン、コンビ、トリオの条件指定        
        // if(!empty($s_numberofpeople)) {
        //     foreach($s_numberofpeople as $value){
        //         $query->whereHas('entertainer', function ($que) use ($value) {
        //             $que->orWhere('numberofpeople', '=', $value);
        //         });
        //     }   
        // }



        // //ピン、コンビ、トリオの条件指定        
        // if(!empty($s_numberofpeople)) {
        //         $query->whereHas('entertainer', function ($que) use ($request) {
        //             $que->orWhere('numberofpeople', '=', $request->numberofpeople);
        //             });
        // }


        $perfomers = $query->paginate(15);
        //$perfomers = $query->get();        
        
       
        $now = new \Carbon\Carbon();
        $prefs = config('pref');
        $offices = Office::get(); 
        //dd($offices);

        return view('search', compact('perfomers','now','prefs'));

    }
    
    
}
