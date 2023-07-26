<?php

namespace App\Http\Controllers;

use App\Models\DataRuangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RuangController extends Controller
{
    public function tampilkanRuangan()
    {
        if (request()->ajax()) {
            $ruang = Ruang::all();
            return DataTables::of($ruang)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='lihatruangan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_ruang' onclick='deleteDataRuangan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatableruangan');
    }

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
        $validator = Validator::make(
            $request->all(),
            [
                'nama_ruang' => 'required|unique:ruangs,nama_ruang',
                'kode_ruang' => 'required|unique:ruangs,kode_ruang'
            ],
            [
                'nama_ruang.required' => 'Nama ruangan harus diisi',
                'nama_ruang.unique' => 'Nama ruangan sudah ada',
                'kode_ruang.unique' => 'Kode ruangan sudah digunakan ruangan lain',
                'kode_ruang.required' => 'Kode ruangan harus diisi',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            return response()->json([
                'errors' => $errorMessage,
            ], 422);
        }

        $ruangan = Ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'kode_ruang' => $request->kode_ruang
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Ruangan Berhasil Disimpan!',
            'data' => $ruangan
        ]);
    }

    public function lihatruangan($id)
    {
        $ruang = Ruang::findorfail($id);
        return response()->json(['ruang' => $ruang]);
    }

    public function updateruangan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'required|unique:ruangs,nama_ruang,' . $id,
        ],
        [
            'nama_ruang.unique' => 'Nama ruangan sudah ada',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            return response()->json([
                'errors' => $errorMessage,
            ], 422);
        } else {
            $ruang = Ruang::findorfail($id);

            $ruang->nama_ruang = $request->input('nama_ruang');
            $ruang->kode_ruang = $request->input('kode_ruang');
            $ruang->save();

            return response()->json([
                'success' => true,
                'message' => 'Data ruangan berhasil diupdate!',
                'data' => $ruang
            ]);
        }
    }
}
