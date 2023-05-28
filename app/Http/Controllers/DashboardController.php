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
        $bbarang = KondisiBarangModel::count();
        $bbaik = KondisiBarangModel::where('kondisi', '1')->count();
        $bruring = KondisiBarangModel::where('kondisi', '2')->count();
        $bruber = KondisiBarangModel::where('kondisi', '3')->count();

        $tbaik = DataAsetTanahModel::where('kondisi', 'Baik')->count();
        $truring = DataAsetTanahModel::where('kondisi', 'Rusak Ringan')->count();
        $truber = DataAsetTanahModel::where('kondisi', 'Rusak Berat')->count();

        return view('pages.dashboard', compact('bbarang', 'bbaik', 'bruring', 'bruber', 'tbaik', 'truring', 'truber'));
    }

}
