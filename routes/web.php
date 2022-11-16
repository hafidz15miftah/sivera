<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

//Route ke Halaman Tentang Sivera
Route::get('/sivera', function() {
    return view('pages.about');
});

//Route ke Tambah Barang
Route::get('/tambah-barang', function() {
    return view('pages.addbarang');
});

//Route ke Tambah Barang
Route::get('/pengguna', function() {
    return view('pages.users');
});


//Route ke Halaman Pusat Bantuan
Route::get('/bantuan', function() {
    return view('pages.help');
});

//Route Untuk Mengakses Daftar Aset
Route::middleware(['auth::sanctum', 'verified', 'role:kup'])->get('/aset', [AsetController::class, 'indeksaset'])->name('aset');
Route::get('/aset', [AsetController::class, 'tampilaset'])->name('tampilaset')->middleware('auth','role:kup');

//Route Untuk Mengakses Daftar Barang
Route::middleware(['auth:sanctum', 'verified','role:kup'])->get('/barang', [BarangController::class, 'indeksbarang'])->name('barang');
Route::get('/barang', [BarangController::class, 'tampilbarang'])->name('tampilbarang')->middleware('auth','role:kup');

//Route Untuk Membuka Halaman Login
Route::get('/login', function()  {
    return view('pages.login');
})->name('login');

//Route AuthController Untuk Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Route Untuk Membuka Halaman Dasbor
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';