<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// reset password petugas not APi
Route::get('petugas_password/reset', 'PetugasAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('petugas_password/email', 'PetugasAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('petugas_password/reset/{token}', 'PetugasAuth\ResetPasswordController@showResetForm');
Route::post('petugas_password/reset', 'PetugasAuth\ResetPasswordController@reset');
// show reset succes controller
Route::get('password_succes','PetugasAuth\PasswordSuccesController@index');
// end reset password

Route::group(['middleware' => 'auth'], function() {

    //yang memiliki role admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
    });
    Route::group(['middleware' => ['role:petugas']], function() {
        Route::get('/laporan','LaporanController@index')->name('laporan.index');
    });
    Route::group(['middleware'=>['permission:akses_petugas']],function(){

        route::resource('/petugas','petugasController');
    });
    Route::group(['middleware'=>['permission:akses_pelanggan']],function(){
        route::resource('/pelanggan','pelangganController');
    });
    Route::group(['middleware' => ['permission:akses_laporan']], function() {
        Route::get('/laporan','LaporanController@index')->name('laporan.index');
    });
    // pengeluran

    Route::resource('/pengeluaran','PengeluaranController');





    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/ganti_password','GantiPasswordController@index')->name('ganti.index');
    Route::post('/gantiAction','GantiPasswordController@action')->name('ganti.action');
    Route::post('/coba','LaporanController@coba')->name('laporan.coba');
    Route::post('/cari','LaporanController@cari')->name('laporan.cari');
    // Route::post('/pdf','LaporanController@cari')->name('laporan.pdf');
    Route::get('/cetakPdf/','LaporanController@cetakPdf')->name('laporan.cetakPdf');
});
