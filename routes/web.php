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

Route::get('/', function () {
    return view('welcome');
});

Route::get('search','MeteranController@index');
Route::post('/action','MeteranController@search')->name('search');
Route::post('/save','MeteranController@save')->name('save');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// route untuk back end admin
route::resource('/pelanggan','pelangganController');
