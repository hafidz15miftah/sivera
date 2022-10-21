<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //Untuk melihat halaman Data Barang
    public function indeksbarang()
    {
        return view('pages.datatablebarang');
    }

    //Untuk menampilkan tabel Barang
    public function tampilbarang()
    {
        $barang = DataBarangModel::select('*')->get();
        return view('pages.datatablebarang', ['barang' => $barang]);
    }
}
