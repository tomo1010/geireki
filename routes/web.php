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




//トップページ
Route::get('/', 'EntertainersController@index')->name('top');
Route::get('searchbox', 'EntertainersController@searchbox')->name('searchbox');


//芸人データ
Route::get('entertainers/all', 'EntertainersController@all')->name('entertainers.all');
Route::get('entertainers/{id}', 'EntertainersController@show')->name('entertainers.show');


//個人データ
Route::get('perfomers/all', 'PerfomersController@all')->name('perfomers.all');
Route::get('perfomers/nsc', 'PerfomersController@nsc')->name('perfomers.nsc');
Route::get('perfomers/{id}', 'PerfomersController@show')->name('perfomers.show');



//ガチャ
Route::get('perfomers/hinaGacha', 'PerfomersController@hinaGacha')->name('hinaGacha');



//一覧表示
Route::get('lists/history', 'ListsController@history')->name('lists.history');
Route::get('lists/history/{year}', 'ListsController@historyList')->name('lists.historyList');
Route::post('/', 'ListsController@selectYear')->name('lists.select');
Route::get('lists/office', 'ListsController@office')->name('lists.office');
Route::get('lists/office/{id}', 'ListsController@officeList')->name('lists.officeList');
Route::get('lists/age', 'ListsController@age')->name('lists.age');
Route::get('lists/age/{year}', 'ListsController@ageList')->name('lists.ageList');
Route::get('lists/age2/{yearsOld}', 'ListsController@age2List')->name('lists.age2List');
Route::get('lists/pref', 'ListsController@pref')->name('lists.pref');
Route::get('lists/pref/{pref}', 'ListsController@prefList')->name('lists.prefList');
Route::get('lists/award', 'ListsController@award')->name('lists.award');
Route::get('lists/award/{year}', 'ListsController@awardList')->name('lists.awardList');
Route::get('lists/awardGp/{gp}', 'ListsController@awardGp')->name('lists.awardGp');
Route::get('lists/awardCal', 'ListsController@awardCal')->name('lists.awardCal');
Route::get('lists/birthday', 'ListsController@birthday')->name('lists.birthday');
Route::get('lists/birthdayList/{birthday}', 'ListsController@birthdayList')->name('lists.birthdayList');


//ランキング
//Route::get('ranking/index', 'RankingController@index')->name('ranking.index');
Route::get('ranking/ageDiff', 'RankingController@ageDiff')->name('ranking.ageDiff');
Route::get('ranking/favorite', 'RankingController@favorite')->name('ranking.favorite');
Route::get('ranking/youtubeCount', 'RankingController@youtubeCount')->name('ranking.youtubeCount');
Route::get('ranking/tall', 'RankingController@tall')->name('ranking.tall');
Route::get('ranking/short', 'RankingController@short')->name('ranking.short');
Route::get('ranking/award', 'RankingController@award')->name('ranking.award');
Route::get('ranking/heightDiff', 'RankingController@heightDiff')->name('ranking.heightDiff');
//Route::get('ranking/heightSum', 'RankingController@heightSum')->name('ranking.heightSum');
Route::get('ranking/yearDiff', 'RankingController@yearDiff')->name('ranking.yearDiff');
Route::get('ranking/tag', 'TagsController@tagRanking')->name('ranking.tag');


//検索
Route::get('search', 'SearchController@search')->name('search');


// signup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


// sitemap-indexのルート
Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap');
Route::group(['prefix' => 'sitemaps'], function() {
// sitemapのルート
Route::get('basics.xml', 'SitemapController@basics')->name('sitemap-basics');
// sitemapを増やす場合はココに追記していく。
});



//ユーザのみ
Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get('favorite', 'FavoriteController@store')->name('user.favorite');
        Route::get('unfavorite', 'FavoriteController@destroy')->name('user.unfavorite');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
        Route::get('tags', 'UsersController@tags')->name('users.tags');        

        Route::get('edit', 'UsersController@edit')->name('users.edit'); 
        Route::put('/', 'UsersController@update')->name('users.update');

    });    


    Route::group(['prefix' => 'entertainers/{id}'], function () {
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        
        
    });    
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', ]]);
    Route::resource('youtubes', 'YoutubesController');


    Route::post('tagging', 'TagEntertainerController@store')->name('tagentertainer.store');
    Route::delete('untagging', 'TagEntertainerController@destroy')->name('tagentertainer.destroy');

    });



// 管理者のみ
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    
    Route::get('/', function () {
    return view('users.admin');
    })->name('admin');
    
    //芸人データ編集その他
    Route::post('entertainer', 'EntertainersController@store')->name('entertainers.store');
    Route::get('entertainers/create', 'EntertainersController@create')->name('entertainers.create');
    Route::put('entertainers/{id}', 'EntertainersController@update')->name('entertainers.update');
    Route::delete('entertainers/{id}', 'EntertainersController@destroy')->name('entertainers.destroy');
    Route::get('entertainers/{id}/edit', 'EntertainersController@edit')->name('entertainers.edit');
    
    //個人データ編集その他
    Route::post('perfomer', 'PerfomersController@store')->name('perfomers.store');
    Route::get('perfomers/create', 'PerfomersController@create')->name('perfomers.create');
    Route::put('perfomers/{id}', 'PerfomersController@update')->name('perfomers.update');
    Route::delete('perfomers/{id}', 'PerfomersController@destroy')->name('perfomers.destroy');
    Route::get('perfomers/{id}/edit', 'PerfomersController@edit')->name('perfomers.edit');
    
    //メンバー（中間テーブル）データ編集その他    
    //Route::resource('members', 'MembersController');
    // Route::get('members/create', 'MembersController@create')->name('members.create');    


    //タグ
    Route::resource('tags', 'TagsController');

    
    /*
    csv処理
    */
    
    // 芸人データ 
    Route::get('csv/entertainer', 'CsvController@uploadEntertainer');
    Route::post('csv/entertainer', 'CsvController@importEntertainer')->name('csv.importEntertainer');
    Route::get('csv/entertainer_dl', 'CsvController@exportEntertainer')->name('csv.exportEntertainer'); 
    
    
    // 事務所データ 
    Route::get('csv/office', 'CsvController@uploadOffice');
    Route::post('csv/office', 'CsvController@importOffice')->name('csv.importOffice');
    Route::get('csv/office_dl', 'CsvController@exportOffice')->name('csv.exportOffice');
    
    
    // 個人データ 
    Route::get('csv/perfomer', 'CsvController@uploadPerfomer');
    Route::post('csv/perfomer', 'CsvController@importPerfomer')->name('csv.importPerfomer');
    Route::get('csv/perfomer_dl', 'CsvController@exportPerfomer')->name('csv.exportPerfomer');     


    // 芸人個人（中間）データ 
    Route::get('csv/member', 'CsvController@uploadMember');
    Route::post('csv/member', 'CsvController@importMember')->name('csv.importMember');
    Route::get('csv/member_dl', 'CsvController@exportMember')->name('csv.exportMember');         
    
    
    // 受賞歴データ 
    Route::get('csv/award', 'CsvController@uploadAward');
    Route::post('csv/award', 'CsvController@importAward')->name('csv.importAward');    
    Route::get('csv/award_dl', 'CsvController@exportAward')->name('csv.exportAward');         
 
    
    // おすすめYouutbeデータ 
    Route::get('csv/youtube', 'CsvController@uploadYoutube');
    Route::post('csv/youtube', 'CsvController@importYoutube')->name('csv.importYoutube');    
    Route::get('csv/youtube_dl', 'CsvController@exportYoutube')->name('csv.exportYoutube');             


    // お気に入りYouutbeデータ(Favorite)
    Route::get('csv/favorite', 'CsvController@uploadFavorite');
    Route::post('csv/favorite', 'CsvController@importFavorite')->name('csv.importFavorite');    
    Route::get('csv/favorite_dl', 'CsvController@exportFavorite')->name('csv.exportFavorite'); 
    
    
    // tagデータ
    Route::get('csv/tag', 'CsvController@uploadTag');
    Route::post('csv/tag', 'CsvController@importTag')->name('csv.importTag');    
    Route::get('csv/tag_dl', 'CsvController@exportTag')->name('csv.exportTag');     
    

});
