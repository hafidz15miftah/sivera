<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use App\Models\DataBarangModel;
use App\Models\KondisiBarangModel;
use App\Models\LaporanModel;
use App\Models\VerifikasiLaporanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // Mengambil data dari model berdasarkan bulan
$laporan = VerifikasiLaporanModel::all(); // Ganti dengan query yang sesuai untuk mengambil data berdasarkan bulan

// Array untuk menyimpan jumlah laporan per bulan
$jumlahLaporanPerBulan = [];

// Looping untuk menghitung jumlah laporan per bulan
foreach ($laporan as $lap) {
    // Ambil bulan dari tanggal_dilaporkan
    $bulan = date('F', strtotime($lap->tanggal_dilaporkan));

    // Jika bulan belum ada dalam array, tambahkan dengan nilai 1
    if (!isset($jumlahLaporanPerBulan[$bulan])) {
        $jumlahLaporanPerBulan[$bulan] = 1;
    } else {
        // Jika bulan sudah ada dalam array, tambahkan dengan 1
        $jumlahLaporanPerBulan[$bulan]++;
    }
}

// Array untuk labels bulan
$labels = array_keys($jumlahLaporanPerBulan);

// Array untuk data jumlah laporan
$dataLaporan = array_values($jumlahLaporanPerBulan);

// Memastikan $labels terdefinisi dengan array kosong jika tidak ada laporan
if (empty($labels)) {
    $labels = [];
}
        $bbarang = KondisiBarangModel::count();
        $bbaik = KondisiBarangModel::where('kondisi', '1')->count();
        $bruring = KondisiBarangModel::where('kondisi', '2')->count();
        $bruber = KondisiBarangModel::where('kondisi', '3')->count();

        $tbaik = DataAsetTanahModel::where('kondisi', 'Baik')->count();
        $truring = DataAsetTanahModel::where('kondisi', 'Rusak Ringan')->count();
        $truber = DataAsetTanahModel::where('kondisi', 'Rusak Berat')->count();

        return view('pages.dashboard', compact('bbarang', 'bbaik', 'bruring', 'bruber', 'tbaik', 'truring', 'truber'), ['labels' => $labels, 'dataLaporan' => $dataLaporan]);
    }

}
