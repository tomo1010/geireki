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

        //getパラメータから「解散済みを含めるか？」のチェックを受け取る        
        $disband = request('disband');

        if($disband == '1'){
            $query = Perfomer::with(['entertainer', 'office'])->orderBy('active', 'desc');
        }
        else{
            $query = Perfomer::with(['entertainer', 'office'])->where('activeend', NULL)->orderByRaw('active desc, name desc');
        }



        // 検索条件の値を取得
        $s_name = $request->input('s_name');
        $s_bloodtype = $request->input('s_bloodtype');
        $s_birthplace = $request->input('s_birthplace');

        $s_start = $request->input('s_start'); 
        $s_end = $request->input('s_end');         

        $s_ageStart = $request->input('s_ageStart'); 
        $s_ageEnd = $request->input('s_ageEnd');
        
        $s_age = $request->input('s_age'); 
            if($s_age == '10b'){
                $s_ageStart = 1;
                $s_ageEnd = 19;
            }    
            elseif($s_age == '20a'){
                $s_ageStart = 20;
                $s_ageEnd = 24;
            }
            elseif($s_age == '20b'){
                $s_ageStart = 25;
                $s_ageEnd = 29;
            }
            elseif($s_age == '30a'){
                $s_ageStart = 30;
                $s_ageEnd = 34;
            }
            elseif($s_age == '30b'){
                $s_ageStart = 35;
                $s_ageEnd = 39;
            }
            elseif($s_age == '40a'){
                $s_ageStart = 40;
                $s_ageEnd = 44;
            }
            elseif($s_age == '40b'){
                $s_ageStart = 45;
                $s_ageEnd = 49;
            }            
            elseif($s_age == '50a'){
                $s_ageStart = 50;
                $s_ageEnd = 54;
            }
            elseif($s_age == '50b'){
                $s_ageStart = 55;
                $s_ageEnd = 59;
            }
            elseif($s_age == '60a'){
                $s_ageStart = 60;
                $s_ageEnd = 64;
            }            
            elseif($s_age == '60b'){
                $s_ageStart = 65;
                $s_ageEnd = 69;
            }
            elseif($s_age == '70a'){
                $s_ageStart = 70;
                $s_ageEnd = 74;
            }
            elseif($s_age == '70b'){
                $s_ageStart = 75;
                $s_ageEnd = 79;
            }            
            elseif($s_age == '80a'){
                $s_ageStart = 80;
                $s_ageEnd = 84;
            }
            elseif($s_age == '80b'){
                $s_ageStart = 85;
                $s_ageEnd = 89;
            }
            elseif($s_age == '90a'){
                $s_ageStart = 90;
                $s_ageEnd = 94;
            }
            elseif($s_age == '90b'){
                $s_ageStart = 95;
                $s_ageEnd = 99;
            }
        //dd($s_ageStart,$s_ageEnd);            

        $s_month = $request->input('s_month'); 
        $s_day = $request->input('s_day');                
        
        $s_numberofpeople = $request->input('numberofpeople');
        $s_gender = $request->input('gender');        
        
        $s_office = $request->input('office');        
        
        $s_etc = $request->input('etc');        



        //日付フォーマットへ変換
        $start = Carbon::now()->subYear($s_start)->format('Y-m-d'); //"2011-08-14"
        $end = Carbon::now()->subYear($s_end)->format('Y-m-d'); //"2001-08-14"
        
        $from = Carbon::now()->subYear($s_ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($s_ageEnd)->format('Y-m-d');
        
        //dd($from,$to);


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
// dd($s_numberofpeople);
                    
                    
        //ピン、コンビ、トリオの条件指定        
        if(!empty($s_numberofpeople)) {
            
                $query->whereHas('entertainer', function ($que) use ($s_numberofpeople) {
                    if (count($s_numberofpeople) == 1) {
                        $que->where('numberofpeople', '=', $s_numberofpeople[0]);
                    }
                    else{
                        $que->whereIn('numberofpeople', $s_numberofpeople);
                    }
                });
        }



        //内訳の条件指定        
        if(!empty($s_gender)) {
            
                $query->whereHas('entertainer', function ($que) use ($s_gender) {
                    if (count($s_gender) == 1) {
                        $que->where('gender', '=', $s_gender[0]);
                    }
                    else{
                        $que->whereIn('gender', $s_gender);
                    }
                });
        }




        //事務所        
        if(!empty($s_office)) {
            
                $query->whereHas('office', function ($que) use ($s_office) {
                    if (count($s_office) == 1) {
                        $que->where('office', 'like', "%$s_etc[0]%");
                    }
                    else{
                        $que->where(function ($query) use($s_office) {
                            foreach ($s_office as $awd) {
                                $query->orwhere('office', 'like', "%$awd%");
                            }
                        });
                        // $que->where('award', 'like', '%'.implode($s_etc).'%');
                    }
                });
        }
        
        
        

        //その他の条件指定        
        if(!empty($s_etc)) {
            
                $query->whereHas('entertainer.award', function ($que) use ($s_etc) {
                    if (count($s_etc) == 1) {
                        $que->where('award', 'like', "%$s_etc[0]%");
                    }
                    else{
                        $que->where(function ($query) use($s_etc) {
                            foreach ($s_etc as $awd) {
                                $query->orwhere('award', 'like', "%$awd%");
                            }
                        });
                        // $que->where('award', 'like', '%'.implode($s_etc).'%');
                    }
                });
        }


        // //その他の条件指定        
        // if(!empty($s_etc)) {
        //         $query->whereHas('entertainer.award', function ($que) use ($s_etc) {
        //             $que->Where('award', 'like', '%'.$s_etc.'%');
        //             });
        // }



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
        
       
        $now = new \Carbon\Carbon();
        $prefs = config('pref');
        $offices = Office::get(); 
        //dd($offices);

        return view('search', compact('perfomers','now','prefs','offices','request'));

    }
    
    
}
