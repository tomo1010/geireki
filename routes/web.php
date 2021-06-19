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

Route::get('list/{year}', 'EntertainersController@list')->name('entertainers.list');
Route::post('/', 'EntertainersController@selectYear')->name('entertainers.select');
//Route::post('check', 'EntertainersController@checkDissolution')->name('entertainers.check');



//個人データ
//Route::resource('perfomers', 'PerfomersController');
Route::get('perfomers/{id}', 'PerfomersController@show')->name('perfomers.show');



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


// signup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    });


// 管理者のみ
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    Route::post('entertainer', 'EntertainersController@store')->name('entertainers.store');
    Route::get('entertainers/create', 'EntertainersController@create')->name('entertainers.create');
    Route::put('entertainers/{entertainer}', 'EntertainersController@update')->name('entertainers.update');
    Route::delete('entertainers/{entertainer}', 'EntertainersController@destroy')->name('entertainers.destroy');
    Route::get('entertainers/{entertainer}/edit', 'EntertainersController@edit')->name('entertainers.edit');
    
    // Route::resource('user', 'AdminController');
    

});
