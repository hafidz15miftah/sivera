<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\InfoBarangModel;
use App\Models\KondisiBarangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KondisiController extends Controller
{
    public function tampilkanKondisi()
    {
        $barang = DataBarangModel::all();
        $ruang = Ruang::all();
        if (request()->ajax()) {
            $kondisi = KondisiBarangModel::select(
                'infos.id',
                'infos.kode_detail',
                'infos.kondisi',
                'barangs.nama_barang',
                'kategoris.nama_kategori',
                'ruangs.nama_ruang'
            )
                ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
                ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
                ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
                ->get();
            return DataTables::of($kondisi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='ubahdatakondisi(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_barang' onclick='deleteDataKondisi(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
                    return $tombol;
                })
                ->addColumn('kondisi', function ($row) {
                    if ($row->kondisi == 1) {
                        return "Baik";
                    } elseif ($row->kondisi == 2) {
                        return "Rusak Ringan";
                    } else {
                        return "Rusak Berat";
                    }
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.detailkondisi', compact('barang', 'ruang'));
    }

    
    public function get_info(Request $request){
        if (request()->ajax()) {
            $info = KondisiBarangModel::count();
            return response()->json($info);
        }
        return redirect(404);
    }

    public function lihatkondisi($id){
        $barang = KondisiBarangModel::findorfail($id);
        $nama = DataBarangModel::where('id',$barang->barang_id)->pluck('nama_barang')->first();
        $ruang = Ruang::where('id',$barang->ruang_id)->pluck('nama_ruang')->first();
        return response()->json([$barang, $ruang, $nama]);
    }

    public function updatekondisi(Request $request, $id)
    {
        $barang = KondisiBarangModel::findorfail($id);

        $barang->kondisi = $request->input('kondisi');
        $barang->kode_detail = $request->input('kode_detail');
        $barang->save();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diupdate!',
            'data' => $barang
        ]);
    }

    public function simpankondisi(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'kode_detail' => 'required|unique:infos,kode_detail',
                'barang_id' => 'required',
                'kondisi' => 'required',
            ],[
                'kode_detail.unique' => 'Kode detail barang sudah digunakan.',
                'kode_detail.required' => 'Mohon pilih data barang agar kode detail otomatis ditambahkan.',
                'kode_barang.unique' => 'Kode barang sudah digunakan.',
                'kondisi.required' => 'Kondisi barang harus dipilih.',
            ]
        );

            //Cek Validasi
            if ($validator->fails()) {
                $errors = $validator->errors();
                $errorMessage = $errors->first();

                return response()->json([
                    'errors' => $errorMessage,
                ], 422);
            }

            $barang = DataBarangModel::findorFail($request->barang_id);
            // Membuat Data
            $kondisi = [
                'barang_id' => $barang->id,
                'ruang_id' => $barang->ruang_id,
                'kode_detail' => $request->kode_detail,
                'kondisi' => $request->kondisi,
            ];

            KondisiBarangModel::create($kondisi);

            return response()->json([
                'success' => true,
                'message' => 'Kondisi Barang Berhasil Disimpan!',
            ]);
        }
    }

    public function hapuskondisi(Request $request, $id)
    {
        $kondisi = KondisiBarangModel::findorfail($id);
        if ($request->ajax()) {
            if ($kondisi) {
                $kondisi->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Detail barang berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }
}
