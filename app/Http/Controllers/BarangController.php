<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $barang = DataBarangModel::all();
        return view('pages.datatablebarang', ['barang' => $barang]);
    }

    //Untuk menampilkan data ruang saat menambah data barang
    public function tambahbarang()
    {
        $ruang = Ruang::all();
        // dd($ruang);
        return view('pages.addbarang', compact('ruang'));
    }

    //Untuk menghapus data barang
    public function hapusbarang(Request $request, $id){
        $barang = DataBarangModel::findorfail($id);
        if ($request->ajax()){
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data barang '. $barang->username . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
        // return redirect()->route('tampilbarang')->with('toast_success', 'Barang Berhasil Dihapus!');
    }

    //Untuk menyimpan barang
    public function simpanbarang(Request $request)
    {
        $barang = DataBarangModel::create([
            'nama_barang' => $request->nama_barang,
            'tanggal' => $request->tanggal,
            'kode_barang' => $request->kode_barang,
            'kondisi' => $request->kondisi,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'ruang_id' => $request->ruang,
        ]);

        // $ruang = new Ruang;
        // $ruang->ruang_id = $barang->id;
        // dd($barang);

        return redirect()->route('tampilbarang')->withToastSuccess('Barang Berhasil Ditambahkan!');
    }
}
