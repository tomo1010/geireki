<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\EntertainersController;

    Route::controller(EntertainersController::class)->group(function () { 
        //トップページ
        Route::get('/', 'index')->name('top'); 
        Route::get('searchbox', 'searchbox')->name('searchbox'); 
        //芸人データ
        Route::get('entertainers/all', 'all')->name('entertainers.all');
        Route::get('entertainers/{id}', 'show')->name('entertainers.show');

    });

    // //トップページ
    // Route::get('/', [EntertainersController::class, 'index'])->name('top');
    // Route::get('searchbox', 'EntertainersController@searchbox')->name('searchbox');


    // //芸人データ
    // Route::get('entertainers/all', 'EntertainersController@all')->name('entertainers.all');
    // Route::get('entertainers/{id}', 'EntertainersController@show')->name('entertainers.show');



use App\Http\Controllers\PerfomersController;

    Route::controller(PerfomersController::class)->prefix('perfomers')->group(function () { 
        //個人データ
        Route::get('/all', 'all')->name('perfomers.all');
        Route::get('/nsc', 'nsc')->name('perfomers.nsc');
        Route::get('/{id}', 'show')->name('perfomers.show');
        //ガチャ
        Route::get('/hinaGacha', 'hinaGacha')->name('hinaGacha');

    });


    // //個人データ
    // Route::get('perfomers/all', 'PerfomersController@all')->name('perfomers.all');
    // Route::get('perfomers/nsc', 'PerfomersController@nsc')->name('perfomers.nsc');
    // Route::get('perfomers/{id}', 'PerfomersController@show')->name('perfomers.show');
    // //ガチャ
    // Route::get('perfomers/hinaGacha', 'PerfomersController@hinaGacha')->name('hinaGacha');


use App\Http\Controllers\ListsController;

    Route::controller(ListsController::class)->prefix('lists')->group(function () { 
        //一覧表示
        Route::get('/history', 'history')->name('lists.history');
        Route::get('/history/{year}', 'history/{year}')->name('lists.historyList');
        Route::post('/', 'selectYear')->name('lists.select');
        Route::get('/office', 'office')->name('lists.office');
        Route::get('/office/{id}', 'officeList')->name('lists.officeList');
        Route::get('/age', 'age')->name('lists.age');
        Route::get('/age/{year}', 'ageList')->name('lists.ageaList');
        Route::get('/age2', '{yearsOld}')->name('lists.age2List');
        Route::get('/pref', 'pref')->name('lists.pref');
        Route::get('/pref/{pref}', 'prefList')->name('lists.prefList');
        Route::get('/award', 'award')->name('lists.award');
        Route::get('/ward/{year}', 'awardList')->name('lists.awardList');
        Route::get('/awardGp/{gp}', 'awardGp')->name('lists.awardGp');
        Route::get('/awardCal', 'awardCal')->name('lists.awardCal');
        Route::get('/birthday', 'birthday')->name('lists.birthday');
        Route::get('/birthdayList/{birthday}', 'birthdayList')->name('lists.birthdayList');
        

    });


    // //一覧表示
    // Route::get('lists/history', 'ListsController@history')->name('lists.history');
    // Route::get('lists/history/{year}', 'ListsController@historyList')->name('lists.historyList');
    // Route::post('/', 'ListsController@selectYear')->name('lists.select');
    // Route::get('lists/office', 'ListsController@office')->name('lists.office');
    // Route::get('lists/office/{id}', 'ListsController@officeList')->name('lists.officeList');
    // Route::get('lists/age', 'ListsController@age')->name('lists.age');
    // Route::get('lists/age/{year}', 'ListsController@ageList')->name('lists.ageList');
    // Route::get('lists/age2/{yearsOld}', 'ListsController@age2List')->name('lists.age2List');
    // Route::get('lists/pref', 'ListsController@pref')->name('lists.pref');
    // Route::get('lists/pref/{pref}', 'ListsController@prefList')->name('lists.prefList');
    // Route::get('lists/award', 'ListsController@award')->name('lists.award');
    // Route::get('lists/award/{year}', 'ListsController@awardList')->name('lists.awardList');
    // Route::get('lists/awardGp/{gp}', 'ListsController@awardGp')->name('lists.awardGp');
    // Route::get('lists/awardCal', 'ListsController@awardCal')->name('lists.awardCal');
    // Route::get('lists/birthday', 'ListsController@birthday')->name('lists.birthday');
    // Route::get('lists/birthdayList/{birthday}', 'ListsController@birthdayList')->name('lists.birthdayList');






use App\Http\Controllers\RankingController;

    Route::controller(RankingController::class)->prefix('ranking')->group(function () { 
        //一覧表示
        Route::get('/ageDiff', 'ageDiff')->name('ranking.ageDiff');
        Route::get('/ageYoung', 'ageYoung}')->name('ranking.ageYoung');
        Route::post('/ageElderly', 'ageElderly')->name('ranking.ageElderly');

        Route::post('/movieFavorite', 'movieFavorite')->name('ranking.movieFavorite');  
        Route::post('/movieCount', 'movieCount')->name('ranking.movieCount');  
        
        Route::post('/heightTall', 'heightTall')->name('ranking.heightTall');  
        Route::post('/heightShort', 'heightShort')->name('ranking.heightShort');  

        Route::post('/award', 'award')->name('ranking.award');  
        Route::post('/tag', 'tag')->name('ranking.tag');  
        Route::post('/ageElderly', 'ageElderly')->name('ranking.ageElderly');  
        Route::post('/ageElderly', 'ageElderly')->name('ranking.ageElderly');  
        Route::post('/ageElderly', 'ageElderly')->name('ranking.ageElderly');  

    });

    //ランキング
    //Route::get('ranking/index', 'RankingController@index')->name('ranking.index');

    // Route::get('ranking/ageDiff', 'RankingController@ageDiff')->name('ranking.ageDiff');
    // Route::get('ranking/ageYoung', 'RankingController@ageYoung')->name('ranking.ageYoung');
    // Route::get('ranking/ageElderly', 'RankingController@ageElderly')->name('ranking.ageElderly');

    // Route::get('ranking/movieFavorite', 'RankingController@movieFavorite')->name('ranking.movieFavorite');
    // Route::get('ranking/movieCount', 'RankingController@movieCount')->name('ranking.movieCount');

    // Route::get('ranking/heightTall', 'RankingController@heightTall')->name('ranking.heightTall');
    // Route::get('ranking/heightShort', 'RankingController@heightShort')->name('ranking.heightShort');

    // Route::get('ranking/heightDiff', 'RankingController@heightDiff')->name('ranking.heightDiff');
    // Route::get('ranking/heightSum', 'RankingController@heightSum')->name('ranking.heightSum');

    // Route::get('ranking/award', 'RankingController@award')->name('ranking.award');
    // Route::get('ranking/tag', 'RankingController@tag')->name('ranking.tag');
    //Route::get('ranking/historyAvg', 'RankingController@historyAvg')->name('ranking.historyAvg');




use App\Http\Controllers\SearchController;

    Route::controller(SearchController::class)->group(function () { 
        //検索
        Route::get('search', 'search')->name('search');

    });

    // //検索
    // Route::get('search', 'SearchController@search')->name('search');




//ここからエラーで止まった  Trait "Illuminate\Foundation\Auth\RegistersUsers" not found


use App\Http\Controllers\Auth\RegisterController;

    Route::controller(RegisterController::class)->group(function () { 
        //signup
        Route::get('signup', 'showRegistrationForm')->name('signup.get');
        Route::post('signup', 'register')->name('signup.post');

    });


    // // signup
    // Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
    // Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


use App\Http\Controllers\Auth\LoginController;

    Route::controller(LoginController::class)->group(function () { 
        //login
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.post');
        Route::post('logout', 'lologoutgin')->name('logout.get');

    });


    // // login
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login', 'Auth\LoginController@login')->name('login.post');
    // Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


// // sitemap-indexのルート
// Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap');
// Route::group(['prefix' => 'sitemaps'], function() {
// // sitemapのルート
// Route::get('basics.xml', 'SitemapController@basics')->name('sitemap-basics');
// // sitemapを増やす場合はココに追記していく。
// });




//ユーザのみ

use App\Http\Controllers\FavoriteController;

    Route::controller(FavoriteController::class)->prefix('users/{id}')->middleware(['auth'])->group(function () { 
        
        //ユーザのお気に入り、非お気に入り処理
        Route::get('favorite', 'store')->name('user.favorite');
        Route::get('unfavorite', 'destroy')->name('user.unfavorite');

    });



use App\Http\Controllers\UsersController;
    
    Route::controller(UsersController::class)->prefix('users/{id}')->middleware(['auth'])->group(function () { 

        //タグ表示処理、投稿YouTube表示、お気に入りYoutube表示処理
        Route::get('tags', 'tags')->name('users.tags');
        Route::get('youtubes', 'youtubes')->name('users.youtubes');
        Route::get('favorites', 'favorites')->name('users.favorites');

        //ユーザ編集・削除処理
        Route::get('edit', 'edit')->name('users.edit');
        Route::put('/', 'update')->name('users.update');

        //ユーザ表示処理
        Route::resource('users', UsersController::class)->only(['index', 'show']);

    });



use App\Http\Controllers\TagEntertainerController;

    Route::controller(TagEntertainerController::class)->prefix('users/{id}')->middleware(['auth'])->group(function () { 
        
        //タグ・非タグ処理
        Route::get('tagging', 'store')->name('tagentertainer.store');
        Route::get('untagging', 'destroy')->name('tagentertainer.destroy');

    });


    // //ユーザのみ
    // Route::group(['middleware' => ['auth']], function () {
        
    //     Route::group(['prefix' => 'users/{id}'], function () {
    //         Route::get('favorite', 'FavoriteController@store')->name('user.favorite'); //お気に入り処理
    //         Route::get('unfavorite', 'FavoriteController@destroy')->name('user.unfavorite'); //非お気に入り処理
            
    //         Route::get('tags', 'UsersController@tags')->name('users.tags');        
    //         Route::get('youtubes', 'UsersController@youtubes')->name('users.youtubes');        
    //         Route::get('favorites', 'UsersController@favorites')->name('users.favorites');

    //         Route::get('edit', 'UsersController@edit')->name('users.edit'); 
    //         Route::put('/', 'UsersController@update')->name('users.update');

    //     });    


// //稼働してない　芸人フォロー機能？
//     Route::group(['prefix' => 'entertainers/{id}'], function () {
//         Route::get('followings', 'UsersController@followings')->name('users.followings');
//         Route::get('followers', 'UsersController@followers')->name('users.followers');
        
        
//     });    
    
    // Route::resource('users', 'UsersController', ['only' => ['index', 'show', ]]);
    // Route::resource('youtubes', 'YoutubesController');


    // Route::post('tagging', 'TagEntertainerController@store')->name('tagentertainer.store');
    // Route::delete('untagging', 'TagEntertainerController@destroy')->name('tagentertainer.destroy');

    // });



// 管理者のみ

    Route::controller(EntertainersController::class)->prefix('admin')->middleware(['auth', 'can:admin'])->group(function () { 

        //芸人データ編集その他
        Route::post('entertainer', 'store')->name('entertainers.store');
        Route::get('entertainers/create', 'create')->name('entertainers.create');
        Route::put('entertainers/{id}', 'update')->name('entertainers.update');
        Route::delete('entertainers/{id}', 'destroy')->name('entertainers.destroy');
        Route::get('entertainers/{id}/edit', 'edit')->name('entertainers.edit');

    });


    Route::controller(PerfomersController::class)->prefix('admin')->middleware(['auth', 'can:admin'])->group(function () { 

        //個人データ編集その他
        Route::post('perfomer', 'store')->name('perfomers.store');
        Route::get('perfomers/create', 'create')->name('perfomers.create');
        Route::put('perfomers/{id}', 'update')->name('perfomers.update');
        Route::delete('perfomers/{id}', 'destroy')->name('perfomers.destroy');
        Route::get('perfomers/{id}/edit', 'edit')->name('perfomers.edit');

    });

//--ここからroute設定できてない
// 管理者のみ

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    
    // Route::get('/', function () {
    // return view('users.admin');
    // })->name('admin');

 //--ここまでroute設定できてない   

 use App\Http\Controllers\TagsController;

    //タグ管理
    Route::resource('tags', TagsController::class);


    //  //タグ管理
    //  Route::resource('tags', 'TagsController');

    // //芸人データ編集その他
    // Route::post('entertainer', 'EntertainersController@store')->name('entertainers.store');
    // Route::get('entertainers/create', 'EntertainersController@create')->name('entertainers.create');
    // Route::put('entertainers/{id}', 'EntertainersController@update')->name('entertainers.update');
    // Route::delete('entertainers/{id}', 'EntertainersController@destroy')->name('entertainers.destroy');
    // Route::get('entertainers/{id}/edit', 'EntertainersController@edit')->name('entertainers.edit');
    
    // //個人データ編集その他
    // Route::post('perfomer', 'PerfomersController@store')->name('perfomers.store');
    // Route::get('perfomers/create', 'PerfomersController@create')->name('perfomers.create');
    // Route::put('perfomers/{id}', 'PerfomersController@update')->name('perfomers.update');
    // Route::delete('perfomers/{id}', 'PerfomersController@destroy')->name('perfomers.destroy');
    // Route::get('perfomers/{id}/edit', 'PerfomersController@edit')->name('perfomers.edit');
    
    //メンバー（中間テーブル）データ編集その他    
    //Route::resource('members', 'MembersController');
    // Route::get('members/create', 'MembersController@create')->name('members.create');    



    
    /*
    csv処理
    */
    use App\Http\Controllers\CsvController;

    Route::controller(CsvController::class)->prefix('admin/csv')->middleware(['auth', 'can:admin'])->group(function () { 

        // 芸人データ 
        Route::get('entertainer', 'uploadEntertainer');
        Route::post('entertainer', 'importEntertainer')->name('csv.importOffice');
        Route::get('entertainer_dl', 'exportEntertainer')->name('csv.exportOffice');

        // 事務所データ 
        Route::get('office', 'uploadOffice');
        Route::post('office', 'importOffice')->name('csv.importOffice');
        Route::get('office_dl', 'exportOffice')->name('csv.exportOffice');

        // 個人データ 
        Route::get('perfomer', 'uploadPerfomer');
        Route::post('perfomer', 'importPerfomer')->name('csv.importPerfomer');
        Route::get('perfomer_dl', 'exportPerfomer')->name('csv.exportPerfomer');

        // 芸人個人（中間）データ 
        Route::get('member', 'uploadMember');
        Route::post('member', 'importMember')->name('csv.importMember');
        Route::get('member_dl', 'exportMember')->name('csv.exportMember');

        // 受賞歴データ 
        Route::get('award', 'uploadAward');
        Route::post('award', 'importAward')->name('csv.importAward');
        Route::get('award_dl', 'exportAward')->name('csv.exportAward');

        // おすすめYoutubeデータ 
        Route::get('youtube', 'uploadYoutube');
        Route::post('youtube', 'importYoutube')->name('csv.importYoutube');
        Route::get('youtube_dl', 'exportYoutube')->name('csv.exportYoutube');

        // お気に入りYoutubeデータ 
        Route::get('favorite', 'uploadFavorite');
        Route::post('favorite', 'importFavorite')->name('csv.importFavorite');
        Route::get('favorite_dl', 'exportFavorite')->name('csv.exportFavorite');

        // tagデータ 
        Route::get('tag', 'uploadTag');
        Route::post('tag', 'importTag')->name('csv.importTag');
        Route::get('tag_dl', 'exportTag')->name('csv.exportTag');

    });

    
    // // 芸人データ 
    // Route::get('csv/entertainer', 'CsvController@uploadEntertainer');
    // Route::post('csv/entertainer', 'CsvController@importEntertainer')->name('csv.importEntertainer');
    // Route::get('csv/entertainer_dl', 'CsvController@exportEntertainer')->name('csv.exportEntertainer'); 
    
    
    // // 事務所データ 
    // Route::get('csv/office', 'CsvController@uploadOffice');
    // Route::post('csv/office', 'CsvController@importOffice')->name('csv.importOffice');
    // Route::get('csv/office_dl', 'CsvController@exportOffice')->name('csv.exportOffice');
       
    // // 個人データ 
    // Route::get('csv/perfomer', 'CsvController@uploadPerfomer');
    // Route::post('csv/perfomer', 'CsvController@importPerfomer')->name('csv.importPerfomer');
    // Route::get('csv/perfomer_dl', 'CsvController@exportPerfomer')->name('csv.exportPerfomer');     

    // // 芸人個人（中間）データ 
    // Route::get('csv/member', 'CsvController@uploadMember');
    // Route::post('csv/member', 'CsvController@importMember')->name('csv.importMember');
    // Route::get('csv/member_dl', 'CsvController@exportMember')->name('csv.exportMember');         
    
    // // 受賞歴データ 
    // Route::get('csv/award', 'CsvController@uploadAward');
    // Route::post('csv/award', 'CsvController@importAward')->name('csv.importAward');    
    // Route::get('csv/award_dl', 'CsvController@exportAward')->name('csv.exportAward');         
    
    // // おすすめYouutbeデータ 
    // Route::get('csv/youtube', 'CsvController@uploadYoutube');
    // Route::post('csv/youtube', 'CsvController@importYoutube')->name('csv.importYoutube');    
    // Route::get('csv/youtube_dl', 'CsvController@exportYoutube')->name('csv.exportYoutube');             


    // // お気に入りYouutbeデータ(Favorite)
    // Route::get('csv/favorite', 'CsvController@uploadFavorite');
    // Route::post('csv/favorite', 'CsvController@importFavorite')->name('csv.importFavorite');    
    // Route::get('csv/favorite_dl', 'CsvController@exportFavorite')->name('csv.exportFavorite'); 
    
    
    // // tagデータ
    // Route::get('csv/tag', 'CsvController@uploadTag');
    // Route::post('csv/tag', 'CsvController@importTag')->name('csv.importTag');    
    // Route::get('csv/tag_dl', 'CsvController@exportTag')->name('csv.exportTag');     
    

// });
