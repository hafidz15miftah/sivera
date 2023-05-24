<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use App\Models\DataBarangModel;
use App\Models\LaporanModel;
use App\Models\VerifikasiLaporanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $barang = DataBarangModel::count();
        $baik = LaporanModel::select(DB::raw('SUM(baik) as totBaik'))->first();
        $ruring = LaporanModel::select(DB::raw('SUM(rusak_ringan) as totRuring'))->first();
        $ruber = LaporanModel::select(DB::raw('SUM(rusak_berat) as totalRuber'))->first();

        $totalBaik = $baik->totBaik;
        $totalRuring = $ruring->totRuring;
        $totalRuber = $ruber->totalRuber;
        $jumlah = $totalBaik + $totalRuring + $totalRuber;

        $tbaik = DataAsetTanahModel::where('kondisi', 'Baik')->count();
        $truring = DataAsetTanahModel::where('kondisi', 'Rusak Ringan')->count();
        $truber = DataAsetTanahModel::where('kondisi', 'Rusak Berat')->count();

        return view('pages.dashboard', compact('barang','totalBaik','totalRuring','totalRuber','jumlah', 'tbaik', 'truring', 'truber'));
    }

}
