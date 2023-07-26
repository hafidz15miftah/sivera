<?php

use App\Http\Controllers\AsetJalanController;
use App\Http\Controllers\AsetKendaraanController;
use App\Http\Controllers\AsetTanahController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportLaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\UserController;
use App\Models\LaporanModel;
use Illuminate\Support\Facades\Auth;
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
Route::get('/sivera', function () {
    return view('pages.about');
});

Route::get('/get-kode', [BarangController::class, 'getKode']);

//Route ke Halaman Profil
Route::get('/profil', [ProfileController::class, 'lihatprofil'])->name('lihatprofil');
Route::post('/editprofil/{id}', [ProfileController::class, 'editprofil'])->name('editprofil');

//Route Untuk Mengakses Kategori
Route::get('/kategori', [KategoriController::class, 'tampilkanKategori'])->middleware('auth');
Route::post('/kategori/simpan', [KategoriController::class, 'simpankategori'])->name('simpankategori')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/kategori/hapus/{id}', [KategoriController::class, 'hapuskategori'])->name('hapuskategori')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/kategori/lihat/{id}', [KategoriController::class, 'lihatkategori'])->name('lihatkategori')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/kategori/update/{id}', [KategoriController::class, 'updatekategori'])->name('updatekategori')->middleware('auth', 'role:kaurumumadminstaf');

//Route Untuk Mengakses Daftar Laporan
Route::get('/pelaporan', [PelaporanController::class, 'tampilkanPelaporan'])->middleware('auth');
Route::post('/uploadPDF', [PelaporanController::class, 'uploadPDF'])->name('uploadPDF')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/pelaporan/setuju/{id}', [PelaporanController::class, 'setuju'])->name('setujui.pelaporan')->middleware('auth');
Route::post('/pelaporan/tolak/{id}', [PelaporanController::class, 'tolak'])->name('tolak.pelaporan')->middleware('auth');
Route::delete('/pelaporan/hapus/{id}', [PelaporanController::class, 'hapuslaporan'])->name('hapuslaporan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/pelaporan/cetak/bulanan', [ExportLaporanController::class, 'cetak_laporan_perbulan'])->name('cetak_laporan_perbulan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/pelaporan/cetak/tahunan', [ExportLaporanController::class, 'cetak_laporan_pertahun'])->name('cetak_laporan_pertahun')->middleware('auth', 'role:kaurumumadminstaf');

//Route untuk Mengakses Kondisi Barang
Route::get('/kondisi', [KondisiController::class, 'tampilkanKondisi'])->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/kondisi/simpan', [KondisiController::class, 'simpankondisi'])->name('simpankondisi')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/kondisi/hapus/{id}', [KondisiController::class, 'hapuskondisi'])->name('hapuskondisi')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/kondisi/lihat/{id}', [KondisiController::class, 'lihatkondisi'])->name('lihatkondisi')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/kondisi/update/{id}', [KondisiController::class, 'updatekondisi'])->name('updatekondisi')->middleware('auth', 'role:kaurumumadminstaf');

//Route Untuk Mengakses Daftar Laporan Barang
Route::get('/detail', [LaporanController::class, 'tampilkanLaporan'])->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpanlaporan', [LaporanController::class, 'simpanLaporan'])->name('simpanLaporan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatdetailbar/{id}', [LaporanController::class, 'lihatlapbar'])->name('lihatlapbar')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapusdetailbar/{id}', [LaporanController::class, 'hapuslapbar'])->name('hapuslapbar')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updatedetailbar/{id}', [LaporanController::class, 'updatedetailbar'])->name('updatedetailbar')->middleware('auth', 'role:kaurumumadminstaf');
//Route untuk Melakukan Export / Cetak Data Barang
Route::get('/detail/cetak/semua', [ExportLaporanController::class, 'cetak_semua_laporan'])->name('cetak_semua_laporan')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/detail/cetak/barang', [ExportLaporanController::class, 'cetak_laporan_bybarang'])->name('cetak_laporan_bybarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/detail/cetak/pembelian', [ExportLaporanController::class, 'cetak_laporan_bytanggal'])->name('cetak_laporan_bytanggal')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/detail/cetak/ruang', [ExportLaporanController::class, 'cetak_laporan_byruang'])->name('cetak_laporan_byruang')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/detail/cetak/pelaporan', [ExportLaporanController::class, 'cetak_berita_acara'])->name('cetak_berita_acara')->middleware('auth', 'role:kaurumumadminstaf');

//Route Untuk Mengakses Daftar Aset Tanah / Lahan
Route::get('/lahan', [AsetTanahController::class, 'tampilkanLahan'])->name('tampilkanLahan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lahan/cetak/semua', [ExportLaporanController::class, 'cetak_semua_aset'])->name('cetak_semua_aset')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpanlahan', [AsetTanahController::class, 'simpanlahan'])->name('simpanlahan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatlahan/{id}', [AsetTanahController::class, 'lihatlahan'])->name('lihatlahan')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapuslahan/{id}', [AsetTanahController::class, 'hapuslahan'])->name('hapuslahan')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updatelahan/{id}', [AsetTanahController::class, 'updatelahan'])->name('updatelahan')->middleware('auth', 'role:kaurumumadminstaf');

//Route untuk Mengakses Daftar Aset Jalan
Route::get('/jalan', [AsetJalanController::class, 'tampilkanJalan'])->name('tampilkanJalan')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpanjalan', [AsetJalanController::class, 'simpanjalan'])->name('simpanjalan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatjalan/{id}', [AsetJalanController::class, 'lihatjalan'])->name('lihatjalan')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updatejalan/{id}', [AsetJalanController::class, 'updatejalan'])->name('updatejalan')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapusjalan/{id}', [AsetJalanController::class, 'hapusjalan'])->name('hapusjalan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/jalan/cetak/semua', [ExportLaporanController::class, 'cetak_jalan'])->name('cetak_jalan')->middleware('auth', 'role:kaurumumadminstaf');

//Route untuk Mengakses Daftar Aset Kendaraan
Route::get('/kendaraan', [AsetKendaraanController::class, 'tampilkanKendaraan'])->name('tampilkanKendaraan')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpankendaraan', [AsetKendaraanController::class, 'simpankendaraan'])->name('simpankendaraan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatkendaraan/{id}', [AsetKendaraanController::class, 'lihatkendaraan'])->name('lihatkendaraan')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updatekendaraan/{id}', [AsetKendaraanController::class, 'updatekendaraan'])->name('updatekendaraan')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapuskendaraan/{id}', [AsetKendaraanController::class, 'hapuskendaraan'])->name('hapuskendaraan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/kendaraan/cetak/semua', [ExportLaporanController::class, 'cetak_kendaraan'])->name('cetak_kendaraan')->middleware('auth', 'role:kaurumumadminstaf');

//Route Untuk Mengakses Daftar Pengguna
Route::get('/pengguna', [UserController::class, 'tampilkanPengguna'])->name('tampilkanPengguna')->middleware('auth', 'role:kepdesadmin');
Route::post('/pengguna/simpan', [UserController::class, 'simpanpengguna'])->name('simpanpengguna')->middleware('auth', 'role:kepdesadmin');
Route::delete('/pengguna/hapus/{id}', [UserController::class, 'hapuspengguna'])->name('hapuspengguna')->middleware('auth', 'role:kepdesadmin');

//Route Untuk Mengakses Daftar Ruangan
Route::get('/ruangan', [RuangController::class, 'tampilkanRuangan'])->name('tampilkanRuangan')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatruangan/{id}', [RuangController::class, 'lihatruangan'])->name('lihatruangan')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updateruangan/{id}', [RuangController::class, 'updateruangan'])->name('updateruangan')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpanruangan', [RuangController::class, 'simpanruangan'])->name('simpanruangan')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapusruangan/{id}', [RuangController::class, 'hapusruangan'])->name('hapusruangan')->middleware('auth', 'role:kaurumumadminstaf');

//Route Untuk Membuka Halaman Tambah Barang dan Fungsi Simpan
Route::get('/barang', [BarangController::class, 'tampilkanBarang'])->name('tampilkanBarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/get-jumlah-info', [KondisiController::class, 'get_info'])->name('tampilkanBarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/tambahbarang', [BarangController::class, 'tambahbarang'])->name('tambahbarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/lihatdata/{id}', [BarangController::class, 'lihatdata'])->name('lihatdata')->middleware('auth', 'role:kaurumumadminstaf');
Route::put('/updatebarang/{id}', [BarangController::class, 'updatebarang'])->name('updatebarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::post('/simpanbarang', [BarangController::class, 'simpanbarang'])->name('simpanbarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::delete('/hapusbarang/{id}', [BarangController::class, 'hapusbarang'])->name('hapusbarang')->middleware('auth', 'role:kaurumumadminstaf');
Route::get('/barang/cetak/stiker', [ExportLaporanController::class, 'cetak_stiker_all'])->name('cetak_stiker_all')->middleware('auth', 'role:kaurumumadminstaf');

//Route AuthController Untuk Login
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index')->middleware('auth', 'verified');
require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
