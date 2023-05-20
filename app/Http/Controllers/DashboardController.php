<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\LaporanModel;
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

        return view('pages.dashboard', compact('barang','totalBaik','totalRuring','totalRuber','jumlah'));
    }
}
