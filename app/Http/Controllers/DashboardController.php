<?php

namespace App\Http\Controllers;

use App\Models\DataAsetJalanModel;
use App\Models\DataAsetKendaraanModel;
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
        $laporan = VerifikasiLaporanModel::all(); // Ganti dengan query yang sesuai untuk mengambil data berdasarkan bulan

        // Array untuk menyimpan jumlah laporan per bulan
        $jumlahLaporanPerBulan = [];
        
        // Looping untuk menghitung jumlah laporan per bulan
        foreach ($laporan as $lap) {
            // Ambil bulan dari tanggal_dilaporkan
            $bulan = date('F Y', strtotime($lap->tanggal_dilaporkan));
        
            // Jika bulan belum ada dalam array, tambahkan dengan nilai 1
            if (!isset($jumlahLaporanPerBulan[$bulan])) {
                $jumlahLaporanPerBulan[$bulan] = 1;
            } else {
                // Jika bulan sudah ada dalam array, tambahkan dengan 1
                $jumlahLaporanPerBulan[$bulan]++;
            }
        }
        
        // Array untuk labels bulan dan tahun
        $labels = [];
        foreach ($jumlahLaporanPerBulan as $bulan => $jumlah) {
            $labels[] = date('F Y', strtotime($bulan));
        }
        
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
        
        $tbaik = DataAsetTanahModel::where('kondisi', '1')->count();
        $truring = DataAsetTanahModel::where('kondisi', '2')->count();
        $truber = DataAsetTanahModel::where('kondisi', '3')->count();

        $jlBaik = DataAsetJalanModel::where('kondisi', '1')->count();
        $jlRR = DataAsetJalanModel::where('kondisi', '2')->count();
        $jlRB = DataAsetJalanModel::where('kondisi', '3')->count();

        $kBaik = DataAsetKendaraanModel::where('kondisi', '1')->count();
        $kRR = DataAsetKendaraanModel::where('kondisi', '2')->count();
        $kRB = DataAsetKendaraanModel::where('kondisi', '3')->count();

        $Baik = $bbaik + $tbaik + $jlBaik + $kBaik;
        $RusakRingan = $bruring + $truring + $jlRR + $kRR;
        $RusakBerat = $bruber + $truber + $jlRB + $kRB;
        $Semua = $Baik + $RusakRingan + $RusakBerat;
        
        return view('pages.dashboard', compact('bbarang', 'bbaik', 'bruring', 'bruber', 'tbaik', 'truring', 'truber', 'jlBaik', 'jlRR', 'jlRB', 'kBaik', 'kRR', 'kRB', 'Baik', 'RusakRingan', 'RusakBerat', 'Semua'), ['labels' => $labels, 'dataLaporan' => $dataLaporan]);
    }
}
