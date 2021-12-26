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

use Symfony\Component\HttpFoundation\StreamedResponse; //csvダウンロード




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
                'encounter' => $row[11],                
                'official' => $row[12] == '' ? NULL : $row[12],
                'youtube' => $row[13] == '' ? NULL : $row[13],
                'tiktok' => $row[13] == '' ? NULL : $row[14],                
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
                'twitter' => $row[20] == '' ? NULL : $row[20],
                'instagram' => $row[21] == '' ? NULL : $row[21],
                'facebook' => $row[22] == '' ? NULL : $row[22],
                'blog' => $row[23] == '' ? NULL : $row[23],                

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
                'award' => $row[2],
                ]);
            $count++;
        }
 
        return redirect()->action('EntertainersController@index')->with('flash_message', $count . '件登録しました！');
    }







    /*
    // ダウンロード処理
    */


    //事務所
    
    public function exportOffice(Request $request)
    {
        $post = $request->all(); // 本来ならここで、CSV出力のパラメータを受け取り、クエリで絞り込む
        $response = new StreamedResponse(function () use ($request, $post) {
            $stream = fopen('php://output','w');
            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // Officeテーブルの全データを取得
            $results = Office::all();
            if (empty($results[0])) {
                    fputcsv($stream, [
                        'データが存在しませんでした。',
                    ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $this->_csvRow($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream'); 
        $response->headers->set('content-disposition', 'attachment; filename=事務所一覧.csv');

        return $response;
    }


        /*
        * CSVの１行分のデータ　※本来はコントローラに書かない方が良い
        */
        private function _csvRow($row){
                return [
                    $row->id,
                    $row->office,
                ];
            }


    //芸人

    public function exportEntertainer(Request $request)
    {
        $post = $request->all(); // 本来ならここで、CSV出力のパラメータを受け取り、クエリで絞り込む
        $response = new StreamedResponse(function () use ($request, $post) {
            $stream = fopen('php://output','w');
            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // Officeテーブルの全データを取得
            $results = Entertainer::all();
            if (empty($results[0])) {
                    fputcsv($stream, [
                        'データが存在しませんでした。',
                    ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $this->_csvEntertainer($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream'); 
        $response->headers->set('content-disposition', 'attachment; filename=芸人一覧.csv');

        return $response;
    }

        /*
        * CSVの１行分のデータ　※本来はコントローラに書かない方が良い
        */
        private function _csvEntertainer($row){
                return [
                    $row->id,
                    $row->office_id,
                    $row->name,
                    $row->gender,
                    $row->ailias,
                    $row->active,
                    $row->activeend,
                    $row->master,
                    $row->oldname,
                    $row->brain,
                    $row->encounter,
                    $row->official,
                    $row->youtube,          
                ];
            }





    //個人

    public function exportPerfomer(Request $request)
    {
        $post = $request->all(); // 本来ならここで、CSV出力のパラメータを受け取り、クエリで絞り込む
        $response = new StreamedResponse(function () use ($request, $post) {
            $stream = fopen('php://output','w');
            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // Officeテーブルの全データを取得
            $results = Perfomer::all();
            if (empty($results[0])) {
                    fputcsv($stream, [
                        'データが存在しませんでした。',
                    ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $this->_csvPerfomer($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream'); 
        $response->headers->set('content-disposition', 'attachment; filename=個人一覧.csv');

        return $response;
    }

        /*
        * CSVの１行分のデータ　※本来はコントローラに書かない方が良い
        */
        private function _csvPerfomer($row){
                return [
                    $row->id,
                    $row->office_id,
                    $row->name,
                    $row->realname,
                    $row->ailias,
                    $row->birthday,
                    $row->deth,
                    $row->birthplace,
                    $row->bloodtype,
                    $row->height,                    
                    $row->dialect,
                    $row->educational,
                    $row->master,
                    $row->school,
                    $row->active,
                    $row->activeend,
                    $row->spouse,
                    $row->relatives,
                    $row->disciple,
                    $row->official,
                    $row->youtube,
                    $row->twitter,                                                            
                ];
            }




    //受賞歴

    public function exportAward(Request $request)
    {
        $post = $request->all(); // 本来ならここで、CSV出力のパラメータを受け取り、クエリで絞り込む
        $response = new StreamedResponse(function () use ($request, $post) {
            $stream = fopen('php://output','w');
            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // Officeテーブルの全データを取得
            $results = Award::all();
            if (empty($results[0])) {
                    fputcsv($stream, [
                        'データが存在しませんでした。',
                    ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $this->_csvAward($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream'); 
        $response->headers->set('content-disposition', 'attachment; filename=受賞歴一覧.csv');

        return $response;
    }

        /*
        * CSVの１行分のデータ　※本来はコントローラに書かない方が良い
        */
        private function _csvAward($row){
                return [
                    $row->id,
                    $row->entertainer_id,
                    $row->year,
                    $row->award,
                ];
            }





    
}
