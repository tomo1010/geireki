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

Route::get('/', 'EntertainersController@index');
Route::get('upload', 'EntertainersController@uploadcsv');
Route::post('upload', 'EntertainersController@importCsv')->name('entertainer.importCsv');
Route::resource('entertainers', 'EntertainersController');
Route::get('list/{year}', 'EntertainersController@list')->name('entertainers.list');
Route::post('/', 'EntertainersController@selectYear')->name('entertainers.select');
//Route::post('/', 'EntertainersController@checkDissolution')->name('entertainers.check');