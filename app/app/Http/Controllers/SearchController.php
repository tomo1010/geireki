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


        $prefs = config('pref'); //出身地情報読み込み


        /* 
        　検索条件の値を取得
        */
        
        $s_name = $request->input('s_name');
        $s_bloodtype = $request->input('s_bloodtype');
        $s_birthplace = $request->input('s_birthplace');
        
        //地方
        $local = $request->input('local');

        //芸歴
        $s_start = $request->input('s_start'); 
        $s_end = $request->input('s_end');         

        //年齢
        $s_ageStart = $request->input('s_ageStart'); 
        $s_ageEnd = $request->input('s_ageEnd');

        //年代        
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


        $s_month = $request->input('s_month'); 
        $s_day = $request->input('s_day');                
        
        $s_numberofpeople = $request->input('numberofpeople');
        $s_gender = $request->input('gender');        
        
        $office_id = $request->input('office_id');
        $s_judge = $request->input('judge');
        
        $nsc = $request->input('nsc');  
        
        $s_etc = $request->input('etc');        



        //日付フォーマットへ変換
        $start = Carbon::now()->subYear($s_start)->format('Y-m-d'); //"2011-08-14"
        $end = Carbon::now()->subYear($s_end)->format('Y-m-d'); //"2001-08-14"
        
        $from = Carbon::now()->subYear($s_ageStart)->format('Y-m-d');
        $to = Carbon::now()->subYear($s_ageEnd)->format('Y-m-d');
        
        //dd($from,$to);




        /*検索クエリー作成
        */
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


//dd($prefs[1]);
//dd($local);


        // //出身地方        
        if(!empty($local)) {
            //北海道
            if($local == '1'){
                $query->where('birthplace', 'like', '%'.$prefs[1].'%');
            }
            //東北
            elseif($local == '2'){
                $query->where('birthplace', 'like', '%'.$prefs[2].'%');
                for($i = 3; $i<= 7; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //北関東
            elseif($local == '3'){
                $query->where('birthplace', 'like', '%'.$prefs[8].'%');
                for($i = 9; $i<= 11; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //南関東
            elseif($local == '4'){
                $query->where('birthplace', 'like', '%'.$prefs[12].'%');
                $query->orWhere('birthplace', 'like', '%'.$prefs[14].'%');
                $query->orWhere('birthplace', 'like', '%'.$prefs[19].'%');                
            }
            //東京
            elseif($local == '5'){
                $query->where('birthplace', 'like', '%'.$prefs[13].'%');
            }
            //北陸信越
            elseif($local == '6'){
                $query->where('birthplace', 'like', '%'.$prefs[15].'%');
                $query->orWhere('birthplace', 'like', '%'.$prefs[20].'%');                
                for($i = 16; $i<= 18; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //東海
            elseif($local == '7'){
                $query->where('birthplace', 'like', '%'.$prefs[21].'%');
                for($i = 22; $i<= 24; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //近畿
            elseif($local == '8'){
                $query->where('birthplace', 'like', '%'.$prefs[25].'%');
                $query->orWhere('birthplace', 'like', '%'.$prefs[26].'%');                
                for($i = 28; $i<= 30; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //大阪
            elseif($local == '9'){
                $query->where('birthplace', 'like', '%'.$prefs[27].'%');
            }
            //中国
            elseif($local == '10'){
                $query->where('birthplace', 'like', '%'.$prefs[31].'%');
                for($i = 32; $i<= 35; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }            
            //四国
            elseif($local == '11'){
                $query->where('birthplace', 'like', '%'.$prefs[36].'%');
                for($i = 37; $i<= 39; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }
            //九州
            elseif($local == '12'){
                $query->where('birthplace', 'like', '%'.$prefs[40].'%');
                for($i = 41; $i<= 46; $i++){
                    $query->orWhere('birthplace', 'like', '%'.$prefs[$i].'%');
                }
            }            
            //沖縄
            elseif($local == '13'){
                $query->where('birthplace', 'like', '%'.$prefs[47].'%');
            }            
        }    
        



//dd($query);       

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



        //↑の内訳を条件指定        
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
        if(!empty($office_id)) {
            
            if($s_judge == 'notin'){
                $query->whereHas('office', function ($que) use ($office_id) {
                    $que->whereNotIn('id', [$office_id]);
                });
            }
            else{
                $query->whereHas('office', function ($que) use ($office_id) {
                    $que->whereIn('id', [$office_id]);
                });
            }    
        }
        
        

        //NSC出身？
        
        if(!empty($nsc)) {
            if (count($nsc) == 1) {
                $query->where('school', 'like', "%$nsc[0]%");
            }
            else{
                foreach ($nsc as $value) {
                    $query->orwhere('school', 'like', "%$value%");
                }
            }
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
        $counts = $query->count();
        
    
        $now = new \Carbon\Carbon();
        $prefs = config('pref');
        $offices = Office::get(); 
        //dd($offices);
        $flug = 1; //viewの表示を変更するためのフラグ
        
//dd($request);

        return view('search', compact('perfomers','now','prefs','offices','request','flug','counts'));

    }
    
    
}
