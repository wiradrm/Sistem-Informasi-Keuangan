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
    
    Route::get('/spp', 'SppController@koordinat')->name('spp');
    
    Route::get('/pemasukan', 'PemasukanController@index')->name('pemasukan');

    Route::get('/pengeluaran', 'PengeluaranController@index')->name('pengeluaran');

    Route::get('/anggaran', 'AnggaranController@index')->name('anggaran');

    Route::get('/jurnal', 'JurnalController@index')->name('jurnal');

    Route::get('/modal', 'JurnalController@index')->name('modal');

    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');


    Route::group(['middleware' => 'admin'], function () {

        Route::post('/kelas/store', 'KelasController@store')->name('kelas.store');
        Route::put('/kelas/update/{kelas_id}', 'KelasController@update')->name('kelas.update');
        Route::put('/kelas/delete/{kelas_id}', 'KelasController@destroy')->name('kelas.delete');

        Route::post('/guru/store', 'GuruController@store')->name('guru.store');
        Route::put('/guru/update/{guru_id}', 'GuruController@update')->name('guru.update');
        Route::put('/guru/delete/{guru_id}', 'GuruController@destroy')->name('guru.delete');
        Route::get('/guru/export', 'GuruController@export')->name('guru.export');
        Route::post('/guru/import', 'GuruController@import')->name('guru.import');

        Route::post('/siswa/store', 'SiswaController@store')->name('siswa.store');
        Route::put('/siswa/update/{siswa_id}', 'SiswaController@update')->name('siswa.update');
        Route::put('/siswa/delete/{siswa_id}', 'SiswaController@destroy')->name('siswa.delete');
        Route::get('/siswa/export', 'SiswaController@export')->name('siswa.export');
        Route::post('/siswa/import', 'SiswaController@import')->name('siswa.import');

        Route::put('/profile/update/{id}', 'DashboardController@profile')->name('profile.update');

    });

    
});