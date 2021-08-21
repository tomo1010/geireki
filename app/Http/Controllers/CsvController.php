<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entertainer;
use App\Office; 
use App\Perfomer; 
use App\Member; 
use App\Award; 

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



    // entertainerインポート処理

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
                'id' => $row[0], 
                'office_id' => $row[1] == '' ? NULL : $row[1],
                
                'name' => $row[2], 
                'numberofpeople' => $row[3],
                'gender' => $row[4],
                'alias' => $row[5],
                'active' => $row[6] == '' ? NULL : $row[6],
                'activeend' => $row[7] == '' ? NULL : $row[7],
                'master' => $row[8],
                'oldname' => $row[9],
                'brain' => $row[10],
                'encouter' => $row[11],                
                'official' => $row[12] == '' ? NULL : $row[12],
                'youtube' => $row[13] == '' ? NULL : $row[13],
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
                'id' => $row[0], 
                'office' => $row[1], 
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
                'id' => $row[0], 
                'office_id' => $row[1] == '' ? NULL : $row[1],
                
                'name' => $row[2], 
                'realname' => $row[3],
                'alias' => $row[4],
                'birthday' => $row[5] == '' ? NULL : $row[5],
                'deth' => $row[6] == '' ? NULL : $row[6],
                'birthplace' => $row[7],
                'bloodtype' => $row[8],
                'height' => $row[9],
                'dialect' => $row[10],
                'educational' => $row[11],
                'master' => $row[12],
                'school' => $row[13],                
                'active' => $row[14] == '' ? NULL : $row[14],
                'activeend' => $row[15] == '' ? NULL : $row[15],
                
                'spouse' => $row[16] == '' ? NULL : $row[16],            
                'relatives' => $row[17] == '' ? NULL : $row[17],    
                'disciple' => $row[18] == '' ? NULL : $row[18],                
                
                'official' => $row[19] == '' ? NULL : $row[19],
                'youtube' => $row[20] == '' ? NULL : $row[20],

                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '組登録しました！');
    }






    /*memberアップロード画面
    */
    
    public function uploadMember()
    {
        return view("csv.member");
    }


    // memberインポート処理

    public function importMember(Request $request)
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
            Member::insert([
                //'id' => $row[0], 
                'entertainer_id' => $row[0], 
                'perfomer_id' => $row[1],                 
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '件登録しました！');
    }
    






    /*★awardアップロード画面
    */
    
    public function uploadAward()
    {
        return view("csv.award");
    }


    // ★awardインポート処理

    public function importAward(Request $request)
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
 
        // ★★登録処理
        $count = 0;
        foreach($dataList as $row){
            Award::insert([
                //'id' => $row[0], 
                'entertainer_id' => $row[0], 
                'year' => $row[1],                
                'award' => $row[1],                                
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '件登録しました！');
    }





    
}
