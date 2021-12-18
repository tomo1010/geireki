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



//芸人データ
Route::get('/', 'EntertainersController@index');
Route::get('entertainers/all', 'EntertainersController@all')->name('entertainers.all');
Route::get('entertainers/{id}', 'EntertainersController@show')->name('entertainers.show');
Route::get('searchbox', 'EntertainersController@searchbox')->name('searchbox');


//一覧表示
Route::get('lists/history', 'ListsController@history')->name('lists.history');
Route::get('lists/history/{year}', 'ListsController@historyList')->name('lists.historyList');
Route::post('/', 'ListsController@selectYear')->name('lists.select');
Route::get('lists/office', 'ListsController@office')->name('lists.office');
Route::get('lists/office/{id}', 'ListsController@officeList')->name('lists.officeList');
Route::get('lists/age', 'ListsController@age')->name('lists.age');
Route::get('lists/age/{year}', 'ListsController@ageList')->name('lists.ageList');
Route::get('lists/pref', 'ListsController@pref')->name('lists.pref');
Route::get('lists/pref/{pref}', 'ListsController@prefList')->name('lists.prefList');
Route::get('lists/award', 'ListsController@award')->name('lists.award');
Route::get('lists/award/{year}', 'ListsController@awardList')->name('lists.awardList');
Route::get('lists/awardGp/{gp}', 'ListsController@awardGp')->name('lists.awardGp');


//個人データ
Route::get('perfomers/all', 'PerfomersController@all')->name('perfomers.all');
Route::get('perfomers/{id}', 'PerfomersController@show')->name('perfomers.show');
//Route::post('age', 'PerfomersController@age')->name('perfomers.age');


//検索
Route::get('search', 'SearchController@search')->name('search');


// signup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


//ユーザのみ
Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get('favorite', 'FavoriteController@store')->name('user.favorite');
        Route::get('unfavorite', 'FavoriteController@destroy')->name('user.unfavorite');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');        
    });    
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show',]]);
    Route::resource('youtubes', 'YoutubesController');

    });



// 管理者のみ
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    
    Route::get('/', function () {
    return view('users.admin');
    });
    
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
    
    //csv処理
    // 芸人データ 
    Route::get('csv/entertainer', 'CsvController@uploadEntertainer');
    Route::post('csv/entertainer', 'CsvController@importEntertainer')->name('csv.importEntertainer');
    
    // 事務所データ 
    Route::get('csv/office', 'CsvController@uploadOffice');
    Route::post('csv/office', 'CsvController@importOffice')->name('csv.importOffice');

    Route::get('csv/office_dl', 'CsvController@exportOffice')->name('csv.exportOffice');
    Route::get('csv/entertainer_dl', 'CsvController@exportEntertainer')->name('csv.exportEntertainer'); 
    Route::get('csv/perfomer_dl', 'CsvController@exportPerfomer')->name('csv.exportPerfomer');     
    
    
    // 個人データ 
    Route::get('csv/perfomer', 'CsvController@uploadPerfomer');
    Route::post('csv/perfomer', 'CsvController@importPerfomer')->name('csv.importPerfomer');

    // 芸人個人（中間）データ 
    Route::get('csv/member', 'CsvController@uploadMember');
    Route::post('csv/member', 'CsvController@importMember')->name('csv.importMember');
    
    // 受賞歴データ 
    Route::get('csv/award', 'CsvController@uploadAward');
    Route::post('csv/award', 'CsvController@importAward')->name('csv.importAward');    
    

    

});
