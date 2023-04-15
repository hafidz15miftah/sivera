<?php

namespace App\Http\Controllers;

use App\Models\DataRuangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function tampilruangan()
    {
        $ruangan = Ruang::select('*')->get();
        return view('pages.datatableruangan', ['ruangan' => $ruangan]);
    }

    public function tambahruangan()
    {
        $ruangan = Ruang::all();
        return view('pages.addruangan', compact('ruangan'));
    }

    public function simpanruangan(Request $request)
    {
        $ruangan = Ruang::create([
            'nama_ruang' => $request->nama_ruang
        ]);

        return redirect()->route('tampilruangan')->withToastSuccess('Ruangan Berhasil Ditambahkan!');;
    }

    //Untuk menghapus data barang
    public function hapusbarang(Request $request, $id){
        $ruangan = Ruang::findorfail($id);
        if ($request->ajax()){
            if ($ruangan) {
                $ruangan->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data barang '. $ruangan->username . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
        // return redirect()->route('tampilbarang')->with('toast_success', 'Barang Berhasil Dihapus!');
    }
}

