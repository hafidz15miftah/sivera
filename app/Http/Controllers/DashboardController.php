<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $barang = DataBarangModel::count();
        $baik = DataBarangModel::query('barang')->where('kondisi', '=', 'Baik')->count();
        $ruring = DataBarangModel::where('kondisi', 'Rusak Ringan')->count();
        $ruber = DataBarangModel::where('kondisi', 'Rusak Berat')->count();

        return view('pages.dashboard', compact('barang','baik','ruring','ruber'));
    }
}
