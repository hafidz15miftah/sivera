<?php

namespace App\Http\Controllers;

use App\Models\DataRuangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RuangController extends Controller
{
    // public function tampilruangan()
    // {
    //     $ruangan = Ruang::select('*')->get();
    //     return view('pages.datatableruangan', ['ruangan' => $ruangan]);
    // }

    public function tampilkanRuangan()
    {
        if (request()->ajax()) {
            $ruang = Ruang::all();
            return DataTables::of($ruang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $tombol = '<a href="javascript:void(0)" class="edit btn btn-warning text-white btn-sm"><i class="fa fa-pencil-square-o"></i>Ubah</a>';
                $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_ruang' onclick='deleteDataRuangan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                return $tombol;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('pages.datatableruangan');
    }

    // public function tambahruangan()
    // {
    //     $ruangan = Ruang::all();
    //     return view('pages.addruangan', compact('ruangan'));
    // }

    //Untuk menghapus data barang
    public function hapusruangan(Request $request, $id)
    {
        $ruang = Ruang::findorfail($id);
        if ($request->ajax()) {
            if ($ruang) {
                $ruang->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data ruang ' . $ruang->nama_ruang . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
        // return redirect()->route('tampilbarang')->with('toast_success', 'Barang Berhasil Dihapus!');
    }

    public function simpanruangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ruangan = Ruang::create([
            'nama_ruang' => $request->nama_ruang
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Ruangan Berhasil Disimpan!',
            'data' => $ruangan
        ]);
    }

    // public function simpanruangan(Request $request)
    // {
    //     $ruangan = Ruang::create([
    //         'nama_ruang' => $request->nama_ruang
    //     ]);

    //     return redirect()->route('tampilruangan')->withToastSuccess('Ruangan Berhasil Ditambahkan!');;
    // }
}

