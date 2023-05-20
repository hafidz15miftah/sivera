<?php

use App\Http\Controllers\AsetTanahController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportLaporanContoller;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\UserController;
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

//Route ke Halaman Profil
Route::get('/profil', function() {
    return view('pages.profile');
});

//Route ke Halaman Pusat Bantuan
Route::get('/bantuan', function() {
    return view('pages.help');
});


//cetak
Route::get('/cetakbarang', [ExportLaporanContoller::class, 'cetak_semua_barang']);
Route::get('/cetak-laporan', [ExportLaporanContoller::class, 'cetak_semua_laporan'])->name('cetak_semua_laporan');
Route::post('/cetak-laporan-bybarang', [ExportLaporanContoller::class, 'cetak_laporan_bybarang'])->name('cetak_laporan_bybarang');
Route::post('/cetak-laporan-bytanggal', [ExportLaporanContoller::class, 'cetak_laporan_bytanggal'])->name('cetak_laporan_bytanggal');

Route::get('/laporan-barang', [LaporanController::class, 'tampilkanLaporan'])->middleware('auth','role:kaurumum');
Route::post('/simpanlaporan', [LaporanController::class, 'simpanLaporan'])->name('simpanLaporan')->middleware('auth', 'role:kaurumum');

Route::middleware(['auth:sanctum', 'verified','role:kaurumum'])->get('/tanah', [AsetTanahController::class, 'tampiltanah'])->name('tanah');

//Route Untuk Mengakses Daftar Barang
Route::middleware(['auth:sanctum', 'verified','role:kaurumum'])->get('/barang', [BarangController::class, 'indeksbarang'])->name('barang');
Route::get('/barang', [BarangController::class, 'tampilkanBarang'])->name('tampilkanBarang')->middleware('auth','role:kaurumum');

//Route Untuk Mengakses Daftar Pengguna
Route::middleware(['auth:sanctum', 'verified','role:sekdes'])->get('/pengguna', [UserController::class, 'indekspengguna'])->name('pengguna');
Route::get('/pengguna', [UserController::class, 'tampilpengguna'])->name('tampilpengguna')->middleware('auth','role:sekdes');

//Route Untuk Mengakses Daftar Ruangan
Route::middleware(['auth:sanctum', 'verified','role:kaurumum'])->get('/ruangan', [RuangController::class, 'indeksruangan'])->name('ruangan');
Route::get('/ruangan', [RuangController::class, 'tampilkanRuangan'])->name('tampilkanRuangan')->middleware('auth','role:kaurumum');
Route::get('/lihatruangan/{id}', [RuangController::class, 'lihatruangan'])->name('lihatruangan')->middleware('auth', 'role:kaurumum');
Route::put('/updateruangan/{id}', [RuangController::class, 'updateruangan'])->name('updateruangan')->middleware('auth', 'role:kaurumum');

//Route Untuk Membuka Halaman Tambah Barang dan Fungsi Simpan
Route::get('/tambahbarang', [BarangController::class, 'tambahbarang'])->name('tambahbarang')->middleware('auth', 'role:kaurumum');
Route::get('/lihatdata/{id}', [BarangController::class, 'lihatdata'])->name('lihatdata')->middleware('auth', 'role:kaurumum');
Route::put('/updatebarang/{id}', [BarangController::class, 'updatebarang'])->name('updatebarang')->middleware('auth', 'role:kaurumum');
Route::post('/simpanbarang', [BarangController::class, 'simpanbarang'])->name('simpanbarang')->middleware('auth', 'role:kaurumum');
Route::delete('/hapusbarang/{id}', [BarangController::class, 'hapusbarang'])->name('hapusbarang');

//Route Untuk Membuka Halaman Tambah Barang dan Fungsi Simpan
Route::get('/tambahruangan', [RuangController::class, 'tambahruangan'])->name('tambahruangan')->middleware('auth', 'role:kaurumum');
Route::post('/simpanruangan', [RuangController::class, 'simpanruangan'])->name('simpanruangan')->middleware('auth', 'role:kaurumum');
Route::delete('/hapusruangan/{id}', [RuangController::class, 'hapusruangan'])->name('hapusruangan')->middleware('auth', 'role:kaurumum');

//Route AuthController Untuk Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index')->middleware('auth', 'verified');

//Route Untuk Membuka Halaman Dasbor
// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
