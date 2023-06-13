<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LostController;
use App\Models\Lost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// BARANG HILANG
Route::get('/daftar-hilang', [LostController::class, 'index']);
Route::get('/barang-hilang', [LostController::class, 'cari']);

// NEED FIX CONTROLLER
Route::get('/tambah-barang', function () {
    return view('barang.tambah-barang');
});

Route::get('/form-barang-hilang', function () {
    return view('barang.hilang.form');
});

// AUTH
Route::group(['middleware' => 'auth'], function () {

    // BARANG
    Route::resource('/daftar-barang', BarangController::class);
    
    // UPDATE BARANG
    Route::get('/barang-masuk', [BarangController::class, 'tambahView']);
    Route::get('/barang-keluar', [BarangController::class, 'keluarView']);
    Route::resource('/barang', BarangController::class);

    // ADMIN
    Route::get('/profil', [AdminController::class, 'index']);
    Route::get('/ubah-sandi', [AdminController::class, 'sandi']);
    Route::post('/ubah-sandi', [AdminController::class, 'ubahSandi']);
});
