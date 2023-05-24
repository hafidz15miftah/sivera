<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AsetTanahController extends Controller
{
    public function tampilkanLahan()
    {
        if (request()->ajax()) {
            $lahan = DataAsetTanahModel::all();
            return DataTables::of($lahan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' onclick='lihatdatalahan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' onclick='updatedatalahan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_obyek' onclick='deleteDataLahan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('kondisi', function ($row) {
                    if ($row->kondisi == 'Baik') {
                        return "<span class='badge badge-success text-center text-white' style='display: block; text-align: center;'>Baik</span>";
                    } elseif ($row->kondisi == 'Rusak Ringan') {
                        return "<span class='badge badge-warning text-center text-white' style='display: block; text-align: center;'>Rusak Ringan</span>";
                    } else {
                        return "<span class='badge badge-danger text-center text-white' style='display: block; text-align: center;'>Rusak Berat</span>";
                    }
                })
                ->rawColumns(['aksi', 'kondisi'])
                ->make(true);
        }
        return view('pages.datatabletanah');
    }

    //Untuk menyimpan barang
    public function simpanlahan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'nama_obyek' => 'required',
                'no_sertifikat' => 'required|unique:tanah,no_sertifikat',
                'luas' => 'required',
                'alamat' => 'required',
                'kondisi' => 'required',
                'keterangan' => 'nullable|min:4'
            ],[
                'nama_obyek.required' => 'Nama obyek harus diisi.',
                'no_sertifikat.required' => 'Nomor sertifikat harus diisi.',
                'no_sertifikat.unique' => 'Nomor sertifikat sama dengan data yang sudah ada.',
                'luas.unique' => 'Kolom luas harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'kondisi.required' => 'Silahkan pilih kondisi Aset',
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
            $lahan = [
                'nama_obyek' => $request->nama_obyek,
                'no_sertifikat' => $request->no_sertifikat,
                'luas' => $request->luas,
                'alamat' => $request->alamat,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,
            ];

            DataAsetTanahModel::create($lahan);

            return response()->json([
                'success' => true,
                'message' => 'Data Lahan Berhasil Disimpan!',
            ]);
        }
    }

    public function updatelahan(Request $request, $id)
    {
        $lahan = DataAsetTanahModel::findorfail($id);

        $lahan->nama_obyek = $request->input('nama_obyek');
        $lahan->no_sertifikat = $request->input('no_sertifikat');
        $lahan->luas = $request->input('luas');
        $lahan->alamat = $request->input('alamat');
        $lahan->kondisi = $request->input('kondisi');
        $lahan->keterangan = $request->input('keterangan');
        $lahan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data lahan berhasil diupdate!',
            'data' => $lahan
        ]);
    }

    public function hapuslahan(Request $request, $id)
    {
        $lahan = DataAsetTanahModel::findorfail($id);
        if ($request->ajax()) {
            if ($lahan) {
                $lahan->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data obyek ' . $lahan->nama_obyek . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    public function lihatlahan($id){
        $lahan = DataAsetTanahModel::findorfail($id);
        return response()->json([$lahan]);
    }
}