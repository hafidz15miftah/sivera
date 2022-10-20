<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //Untuk melihat halaman Tabel Data Barang
    public function index(){
        return view('pages.datatablebarang');
    }

    //Untuk menampilkan tabel Barang
    public function tampilbarang(){
        $barang = DataBarangModel::select('*')->get();
        return view('pages.datatablebarang', ['barang' => $barang]);
    }
}
