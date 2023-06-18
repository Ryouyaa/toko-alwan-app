<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LostController;

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

// BARANG HILANG
Route::get('/daftar-hilang', [LostController::class, 'index']);

// AUTH
Route::group(['middleware' => 'auth'], function () {

    // LOGIN
    Route::post('/logout', [LoginController::class, 'logout']);

    // BARANG
    Route::get('/daftar-barang', [BarangController::class, 'index']);
    Route::resource('barangs', BarangController::class);

    // BARANG HILANG
    Route::resource('losts', LostController::class);
    Route::get('/barang-hilang', [LostController::class, 'cari']);
    Route::get('/barang-hilang/form/{barang:id}', [LostController::class, 'create']);

    // UPDATE BARANG
    Route::get('/barang-masuk', [BarangController::class, 'tambahView']);
    Route::get('/barang-keluar', [BarangController::class, 'keluarView']);
    
    Route::post('/tambah-barang', [BarangController::class, 'tambahBarang']);
    Route::post('/delete-barang', [BarangController::class, 'deleteBarang']);
    Route::post('/update-barang', [BarangController::class, 'updateBarang']);

    // ADMIN
    Route::get('/profil', [AdminController::class, 'index']);
    Route::get('/ubah-sandi', [AdminController::class, 'sandi']);
    Route::post('/ubah-sandi', [AdminController::class, 'ubahSandi']);
});
