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
Route::get('entertainers/{id}', 'EntertainersController@show')->name('entertainers.show');
Route::get('search', 'EntertainersController@search')->name('entertainers.search');


//一覧表示
Route::get('lists/all', 'ListsController@all')->name('lists.all');
Route::get('lists/history', 'ListsController@history')->name('lists.history');
Route::get('lists/history/{year}', 'ListsController@historyList')->name('lists.historyList');
Route::post('/', 'ListsController@selectYear')->name('lists.select');
Route::get('lists/office', 'ListsController@office')->name('lists.office');
Route::get('lists/office/{id}', 'ListsController@officeList')->name('lists.officeList');
Route::get('lists/age', 'ListsController@age')->name('lists.age');

//個人データ
Route::get('perfomers/{id}', 'PerfomersController@show')->name('perfomers.show');
//Route::post('age', 'PerfomersController@age')->name('perfomers.age');



// signup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//ユーザのみ
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show',]]);
    //Route::get('users/{id}', 'UsersController@show')->name('users.show');
    Route::resource('youtubes', 'YoutubesController');
    });



// 管理者のみ
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    
    //Route::get('admin', 'AdminController@index')->name('users.admin');
    Route::get('/', function () {
    return view('welcome');
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
    
    // 個人データ 
    Route::get('csv/perfomer', 'CsvController@uploadPerfomer');
    Route::post('csv/perfomer', 'CsvController@importPerfomer')->name('csv.importPerfomer');

    // 芸人個人（中間）データ 
    Route::get('csv/member', 'CsvController@uploadMember');
    Route::post('csv/member', 'CsvController@importMember')->name('csv.importMember');
    

});
