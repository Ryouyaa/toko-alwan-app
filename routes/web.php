<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/tambah-barang', function () {
    return view('barang.tambah-barang');
});

Route::get('/daftar-barang', function () {
    return view('barang.daftar-barang');
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

Route::get('/profil', function () {
    return view('admin.profil');
});

Route::get('/ubah-sandi', function () {
    return view('admin.ubah-sandi');
});
