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
        $barang = DataBarangModel::select('*')->get();
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
    public function hapusbarang($id){
        $barang = DataBarangModel::findOrFail($id);
        $barang->delete();
        if ($barang->delete()) {
            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Data berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Terjadi kesalahan saat menghapus data!'
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