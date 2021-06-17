<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entertainer;
use App\Office; 
use App\Perfomer; 

use Goodby\CSV\Import\Standard\LexerConfig; //csvインポート
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;



class CsvController extends Controller
{


    /*entertainerアップロード画面
    */
    
    public function uploadEntertainer()
    {
        return view("csv.entertainer");
    }



    // csvインポート処理

    public function importEntertainer(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
 
        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
 
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);
 
        $dataList = [];
     
        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });
 
        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);
 
        // TMPファイル削除
        unlink($tmpPath);
 
        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Entertainer::insert([
                //'id' => $row[0], 
                'name' => $row[0], 
                'numberofpeople' => $row[1],
                'gender' => $row[2],
                'alias' => $row[3],
                'active' => $row[4],
                'activeend' => $row[5] == '' ? NULL : $row[5],
                'master' => $row[6],
                'oldname' => $row[7],
                'official' => $row[8] == '' ? NULL : $row[8],
                'youtube' => $row[9] == '' ? NULL : $row[9],
                'office_id' => $row[10] == '' ? NULL : $row[10],
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '組登録しました！');
    }
    






    /*officeアップロード画面
    */
    
    public function uploadOffice()
    {
        return view("csv.office");
    }


    // officeインポート処理

    public function importOffice(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
 
        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
 
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);
 
        $dataList = [];
     
        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });
 
        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);
 
        // TMPファイル削除
        unlink($tmpPath);
 
        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Office::insert([
                //'id' => $row[0], 
                'office' => $row[0], 
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '件登録しました！');
    }
    







    /*Perpomerアップロード画面
    */
    
    public function uploadPerfomer()
    {
        return view("csv.perfomer");
    }



    // csvインポート処理

    public function importPerfomer(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
 
        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
 
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);
 
        $dataList = [];
     
        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });
 
        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);
 
        // TMPファイル削除
        unlink($tmpPath);
 
        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Perfomer::insert([
                //'id' => $row[0], 
                'name' => $row[0], 
                'realname' => $row[1],
                'alias' => $row[2],
                'birthday' => $row[3] == '' ? NULL : $row[3],
                'deth' => $row[4] == '' ? NULL : $row[4],
                'birthplace' => $row[5],
                'bloodtype' => $row[6],
                'height' => $row[7],
                'dialect' => $row[8],
                'educational' => $row[9],
                'master' => $row[10],
                'school' => $row[11],                
                'active' => $row[12] == '' ? NULL : $row[12],
                'activeend' => $row[13] == '' ? NULL : $row[13],
                'official' => $row[14] == '' ? NULL : $row[14],
                'youtube' => $row[15] == '' ? NULL : $row[15],
                'entertainer_id' => $row[16] == '' ? NULL : $row[16],
                'office_id' => $row[17] == '' ? NULL : $row[17],
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '組登録しました！');
    }




    
    
    
    
}
