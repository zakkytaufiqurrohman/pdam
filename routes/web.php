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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// route untuk back end admin
route::resource('/pelanggan','pelangganController');
route::resource('/petugas','petugasController');
Route::get('/laporan','LaporanController@index')->name('laporan.index');
Route::post('/coba','LaporanController@coba')->name('laporan.coba');
Route::get('/ganti_password','GantiPasswordController@index')->name('ganti.index');
Route::post('/gantiAction','GantiPasswordController@action')->name('ganti.action');

// reset password petugas not APi
Route::get('petugas_password/reset', 'PetugasAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('petugas_password/email', 'PetugasAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('petugas_password/reset/{token}', 'PetugasAuth\ResetPasswordController@showResetForm');
Route::post('petugas_password/reset', 'PetugasAuth\ResetPasswordController@reset');
// show reset succes controller
Route::get('password_succes','PetugasAuth\PasswordSuccesController@index');
// end reset password
