<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/action','MeteranController@search')->name('search');
route::post('login','PetugasController@login');
Route::group(['middleware'=>'auth:api'],function(){
    Route::post('/created','MeteranController@created')->name('save');
    Route::post('/gantiAction','GantiPasswordController@Api');
});
// api

Route::post('petugas_password/email', 'PetugasAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('petugas_password/reset/{token}', 'PetugasAuth\ResetPasswordController@showResetForm');
Route::post('petugas_password/reset', 'PetugasAuth\ResetPasswordController@reset');
