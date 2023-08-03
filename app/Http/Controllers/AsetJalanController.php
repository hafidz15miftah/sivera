<?php

namespace App\Http\Controllers;

use App\Models\DataAsetJalanModel;
use App\Models\DataAsetTanahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AsetJalanController extends Controller
{
    public function tampilkanJalan()
    {
        if (request()->ajax()) {
            $jalan = DataAsetJalanModel::select(
                'jalans.id',
                'jalans.nama_jalan',
                'jalans.no_dokumen',
                'jalans.panjang',
                'jalans.sumber',
                'jalans.kondisi',
                'jalans.inventarisir',
                'jalans.keterangan',
            )
                ->get();
            $jalan->transform(function ($item) {
                switch ($item->kondisi) {
                    case 1:
                        $item->kondisi = 'Baik';
                        break;
                    case 2:
                        $item->kondisi = 'Rusak Ringan';
                        break;
                    case 3:
                        $item->kondisi = 'Rusak Berat';
                        break;
                    default:
                        $item->kondisi = 'Tidak Diketahui';
                        break;
                }
                return $item;
            });
            return DataTables::of($jalan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='width:50px;' onclick='lihatdatajalan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:50px;' onclick='updatedatajalan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_jalan' onclick='deleteDataJalan(this)' class='btn btn-danger btn-sm' style='margin-top: 3px; width:50px;'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('inventarisir', function ($row) {
                    return \Carbon\Carbon::parse($row->inventarisir)->locale('id')->translatedFormat('l, d F Y');
                })
                ->rawColumns(['aksi', 'kondisi'])
                ->make(true);
        }
        return view('pages.datatablejalan');
    }

    //Untuk menyimpan barang
    public function simpanjalan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'nama_jalan' => 'required',
                    'no_dokumen' => 'required',
                    'panjang' => 'required|numeric',
                    'sumber' => 'required',
                    'kondisi' => 'required',
                    'inventarisir' => 'required',
                    'keterangan' => 'nullable|min:4'
                ],
                [
                    'nama_jalan.required' => 'Nama jalan harus diisi.',
                    'no_dokumen.required' => 'Nomor dokumen harus diisi.',
                    'panjang.required' => 'Kolom panjang harus diisi.',
                    'panjang.numeric' => 'Kolom panjang harus berupa angka.',
                    'sumber.required' => 'Sumber dana harus diisi.',
                    'kondisi.required' => 'Silahkan pilih kondisi jalan',
                    'inventarisir.required' => 'Data tahun inventarisir harus diisi',
                    'keterangan' => 'Keterangan harus memiliki setidaknya :min karakter.',
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

            // Membuat Data
            $jalan = [
                'nama_jalan' => $request->nama_jalan,
                'no_dokumen' => $request->no_dokumen,
                'panjang' => $request->panjang,
                'sumber' => $request->sumber,
                'kondisi' => $request->kondisi,
                'inventarisir' => $request->inventarisir,
                'keterangan' => $request->keterangan,
            ];

            DataAsetJalanModel::create($jalan);

            return response()->json([
                'success' => true,
                'message' => 'Data Jalan Berhasil Disimpan!',
            ]);
        }
    }

    public function updatejalan(Request $request, $id)
    {
        $jalan = DataAsetJalanModel::findorfail($id);
        $jalan->nama_jalan = $request->input('nama_jalan');
        $jalan->no_dokumen = $request->input('no_dokumen');
        $jalan->panjang = $request->input('panjang');
        $jalan->sumber = $request->input('sumber');
        $jalan->kondisi = $request->input('kondisi');
        $jalan->inventarisir = $request->input('inventarisir');
        $jalan->keterangan = $request->input('keterangan');
        $jalan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data jalan berhasil diupdate!',
            'data' => $jalan
        ]);
    }

    public function hapusjalan(Request $request, $id)
    {
        $jalan = DataAsetJalanModel::findorfail($id);
        if ($request->ajax()) {
            if ($jalan) {
                $jalan->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data jalan ' . $jalan->nama_jalan . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    public function lihatjalan($id){
        $jalan = DataAsetJalanModel::findorfail($id);
        return response()->json([$jalan]);
    }
}
