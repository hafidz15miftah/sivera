<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $barang = DataBarangModel::count();
        $baik = DataBarangModel::query('barang')->where('kondisi', '=', '1')->count();
        $rudang = DataBarangModel::where('kondisi', 'Rusak Sedang')->count();
        $ruber = DataBarangModel::where('kondisi', 'Rusak Berat')->count();

        return view('pages.dashboard', compact('barang'));
    }
}
