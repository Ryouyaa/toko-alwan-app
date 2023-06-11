<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;

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

// BARANG
Route::get('/daftar-barang', [BarangController::class, 'index']);

Route::get('/tambah-barang', function () {
    return view('barang.tambah-barang');
});


Route::get('/barang-hilang', function () {
    return view('barang.hilang.cari');
});

Route::get('/form-barang-hilang', function () {
    return view('barang.hilang.form');
});

Route::get('/barang-masuk', function () {
    return view('update.barang-masuk');
});

Route::get('/barang-keluar', function () {
    return view('update.barang-keluar');
});

// ADMIN
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profil', [AdminController::class, 'index']);
    Route::get('/ubah-sandi', [AdminController::class, 'sandi']);
    Route::post('/ubah-sandi', [AdminController::class, 'ubahSandi']);
});
