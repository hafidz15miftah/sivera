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

    //Untuk menambahkan barang
    public function tambahbarang()
    {
        return view('pages.addbarang');
    }

    //Untuk menyimpan barang
    public function simpanbarang(Request $request)
    {
        $barang = DataBarangModel::create([
            'ruang' => $request->ruang,
            'tanggal' => $request->tanggal,
            'kode_barang' => $request->kode_barang,
            'kondisi' => $request->kondisi,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('tampilbarang');
    }
}