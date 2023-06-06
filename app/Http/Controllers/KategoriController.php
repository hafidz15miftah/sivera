<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    //
    public function tampilkanKategori()
    {
        if (request()->ajax()) {
            $kategori = Kategori::all();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='lihatkategori(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_kategori' onclick='deleteKategori(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.categories');
    }

    //Untuk menghapus data kategori
    public function hapuskategori(Request $request, $id)
    {
        $kategori = Kategori::findorfail($id);
        if ($request->ajax()) {
            if ($kategori) {
                $kategori->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data kategori ' . $kategori->nama_kategori . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
        // return redirect()->route('tampilbarang')->with('toast_success', 'Barang Berhasil Dihapus!');
    }

    public function simpankategori(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kategori' => 'required|unique:kategoris,nama_kategori',
                'kode_kategori' => 'required|unique:kategoris,kode_kategori'
            ],
            [
                'nama_kategori.required' => 'Nama kategori harus diisi',
                'nama_kategori.unique' => 'Kategori sudah ada',
                'kode_kategori.unique' => 'Kode kategori sudah digunakan',
                'kode_kategori.required' => 'Kode kategori harus diisi',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            return response()->json([
                'errors' => $errorMessage,
            ], 422);
        }

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => $request->kode_kategori
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Berhasil Disimpan!',
            'data' => $kategori
        ]);
    }

    public function lihatkategori($id)
    {
        $kategori = Kategori::findorfail($id);
        return response()->json(['kategori' => $kategori]);
    }

    public function updatekategori(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $id,
            'kode_kategori' => 'required|unique:kategoris,kode_kategori,' . $id
        ],
        [
            'nama_kategori.unique' => 'Kategori sudah ada',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            return response()->json([
                'errors' => $errorMessage,
            ], 422);
        } else {
            $kategori = Kategori::findorfail($id);

            $kategori->nama_kategori = $request->input('nama_kategori');
            $kategori->kode_kategori = $request->input('kode_kategori');
            $kategori->save();

            return response()->json([
                'success' => true,
                'message' => 'Data ruangan berhasil diupdate!',
                'data' => $kategori
            ]);
        }
    }
}
