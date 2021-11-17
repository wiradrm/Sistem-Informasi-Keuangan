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
    
    Route::get('/guru', 'GuruController@index')->name('guru');

    Route::get('/siswa', 'SiswaController@index')->name('siswa');
    
    Route::get('/kelas', 'KelasController@index')->name('kelas');
    
    Route::get('/spp', 'SppController@index')->name('spp');
    
    Route::get('/pemasukan', 'MasukController@index')->name('pemasukan');

    Route::get('/pengeluaran', 'PengeluaranController@index')->name('pengeluaran');

    Route::get('/anggaran', 'AnggaranController@index')->name('anggaran');

    Route::get('/jurnal', 'JurnalController@index')->name('jurnal');
    Route::get('/modal', 'ModalController@index')->name('modal');



    Route::get('/bayar', 'BayarController@index')->name('bayar');


    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
    
    Route::get('/jurnal/export', 'JurnalController@export')->name('jurnal.export');
    Route::get('/modal/export', 'ModalController@export')->name('modal.export');

    


    Route::group(['middleware' => 'admin'], function () {

        Route::post('/kelas/store', 'KelasController@store')->name('kelas.store');
        Route::put('/kelas/update/{kelas_id}', 'KelasController@update')->name('kelas.update');
        Route::put('/kelas/delete/{kelas_id}', 'KelasController@destroy')->name('kelas.delete');

        Route::post('/guru/store', 'GuruController@store')->name('guru.store');
        Route::put('/guru/update/{guru_id}', 'GuruController@update')->name('guru.update');
        Route::put('/guru/delete/{guru_id}', 'GuruController@destroy')->name('guru.delete');
        Route::post('/guru/import', 'GuruController@import')->name('guru.import');

        Route::post('/siswa/store', 'SiswaController@store')->name('siswa.store');
        Route::put('/siswa/update/{siswa_id}', 'SiswaController@update')->name('siswa.update');
        Route::put('/siswa/delete/{siswa_id}', 'SiswaController@destroy')->name('siswa.delete');
        Route::post('/siswa/import', 'SiswaController@import')->name('siswa.import');

        Route::post('/pemasukan/store', 'MasukController@store')->name('pemasukan.store');
        Route::put('/pemasukan/update/{id}', 'MasukController@update')->name('pemasukan.update');
        Route::put('/pemasukan/delete/{id}', 'MasukController@destroy')->name('pemasukan.delete');

        Route::post('/pengeluaran/store', 'PengeluaranController@store')->name('pengeluaran.store');
        Route::put('/pengeluaran/update/{id_transaksi}', 'PengeluaranController@update')->name('pengeluaran.update');
        Route::put('/pengeluaran/delete/{id_transaksi}', 'PengeluaranController@destroy')->name('pengeluaran.delete');
        
        Route::post('/anggaran/store', 'AnggaranController@store')->name('anggaran.store');
        Route::put('/anggaran/update/{id}', 'AnggaranController@update')->name('anggaran.update');
        Route::put('/anggaran/delete/{id}', 'AnggaranController@destroy')->name('anggaran.delete');
        Route::post('/anggaran/import', 'AnggaranController@import')->name('anggaran.import');

        Route::post('/spp/store', 'SppController@store')->name('spp.store');
        Route::put('/spp/update/{spp_id}', 'SppController@update')->name('spp.update');
        Route::put('/spp/delete/{spp_id}', 'SppController@destroy')->name('spp.delete');

        Route::post('/bayar/update/{id}', 'BayarController@update')->name('bayar.update');
        Route::post('/bayar/import', 'BayarController@import')->name('bayar.import');

        // Route::get('/jurnal/export', 'JurnalController@export')->name('jurnal.export');
        // Route::get('/modal/export', 'ModalController@export')->name('modal.export');


        Route::put('/profile/update/{id}', 'DashboardController@profile')->name('profile.update');

    });

    
});