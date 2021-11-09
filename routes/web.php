<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    
    Route::get('/order', 'OrderController@index')->name('order');
    Route::get('/produk', 'ProdukController@index')->name('produk');
    Route::get('/am', 'AMController@index')->name('am');
    Route::get('/koordinat', 'PelangganController@koordinat')->name('koordinat');
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
    Route::get('/karyawan', 'KaryawanController@index')->name('karyawan');
    Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
    Route::get('/posting', 'PostingController@index')->name('posting');
    Route::post('/posting/store', 'PostingController@store')->name('posting.store');
    Route::put('/posting/update/{id}', 'PostingController@update')->name('posting.update');
    Route::put('/posting/delete/{id}', 'PostingController@destroy')->name('posting.delete');
    Route::get('/posting/export', 'PostingController@export')->name('posting.export');
    Route::post('/am/store', 'AMController@store')->name('am.store');
    Route::put('/am/update/{id}', 'AMController@update')->name('am.update');
    Route::put('/am/delete/{id}', 'AMController@destroy')->name('am.delete');
    Route::get('/am/export', 'AMController@export')->name('am.export');
    Route::post('/am/import', 'AMController@import')->name('am.import');

    Route::get('/request', 'RequestController@index')->name('request');
    Route::post('/request/store', 'RequestController@store')->name('request.store');
    Route::get('/request/export', 'RequestController@export')->name('request.export');

    Route::get('/karyawan/ranking', 'RankingController@index')->name('ranking');
    Route::get('/karyawan/ranking/export', 'RankingController@export')->name('ranking.export');


    Route::group(['middleware' => 'admin'], function () {
        Route::post('/produk/store', 'ProdukController@store')->name('produk.store');
        Route::put('/produk/update/{id}', 'ProdukController@update')->name('produk.update');
        Route::put('/produk/delete/{id}', 'ProdukController@destroy')->name('produk.delete');
        Route::get('/produk/export', 'ProdukController@export')->name('produk.export');
        Route::post('/produk/import', 'ProdukController@import')->name('produk.import');
        Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

        Route::post('/karyawan/store', 'KaryawanController@store')->name('karyawan.store');
        Route::put('/karyawan/update/{id}', 'KaryawanController@update')->name('karyawan.update');
        Route::put('/karyawan/delete/{id}', 'KaryawanController@destroy')->name('karyawan.delete');
        Route::get('/karyawan/export', 'KaryawanController@export')->name('karyawan.export');
        Route::post('/karyawan/import', 'KaryawanController@import')->name('karyawan.import');

        Route::put('/profile/update/{id}', 'KaryawanController@profile')->name('profile.update');

        Route::post('/pelanggan/store', 'PelangganController@store')->name('pelanggan.store');
        Route::put('/pelanggan/update/{nipnas}', 'PelangganController@update')->name('pelanggan.update');
        Route::put('/pelanggan/delete/{nipnas}', 'PelangganController@destroy')->name('pelanggan.delete');
        Route::get('/pelanggan/export', 'PelangganController@export')->name('pelanggan.export');
        Route::post('/pelanggan/import', 'PelangganController@import')->name('pelanggan.import');

        Route::post('/order/store', 'OrderController@store')->name('order.store');
        Route::put('/order/update/{order_id}', 'OrderController@update')->name('order.update');
        Route::put('/order/delete/{order_id}', 'OrderController@destroy')->name('order.delete');
        Route::get('/order/export', 'OrderController@export')->name('order.export');
        Route::post('/order/import', 'OrderController@import')->name('order.import');

        Route::get('/notification/terima/{id}/{user_id}', 'NotificationController@approve')->name('notification.approve');
        Route::get('/notification/tolak/{id}/{user_id}', 'NotificationController@cancel')->name('notification.cancel');
    });
});