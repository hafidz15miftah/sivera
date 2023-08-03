<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AsetTanahController extends Controller
{
    public function tampilkanLahan()
    {
        if (request()->ajax()) {
            $lahan = DataAsetTanahModel::select(
                'tanah.id',
                'tanah.nama_obyek',
                'tanah.alamat',
                'tanah.no_sertifikat',
                'tanah.luas',
                'tanah.kondisi',
                'tanah.inventarisir',
                'tanah.keterangan',
            )
            ->get();
            $lahan->transform(function ($item) {
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
            return DataTables::of($lahan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='margin-right: 3px;' onclick='lihatdatalahan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='updatedatalahan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_obyek' onclick='deleteDataLahan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('inventarisir', function ($row) {
                    return \Carbon\Carbon::parse($row->inventarisir)->locale('id')->translatedFormat('l, d F Y');
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
                'no_sertifikat' => 'required',
                'luas' => 'required|numeric',
                'alamat' => 'required',
                'kondisi' => 'required',
                'inventarisir' => 'required',
                'keterangan' => 'nullable|min:4'
            ],[
                'nama_obyek.required' => 'Nama obyek harus diisi.',
                'no_sertifikat.required' => 'Nomor sertifikat harus diisi.',
                'luas.required' => 'Kolom luas harus diisi.',
                'luas.numeric' => 'Kolom luas harus berupa angka.',
                'alamat.required' => 'Alamat harus diisi.',
                'kondisi.required' => 'Silahkan pilih kondisi tanah',
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
            $lahan = [
                'nama_obyek' => $request->nama_obyek,
                'no_sertifikat' => $request->no_sertifikat,
                'luas' => $request->luas, 
                'alamat' => $request->alamat,
                'kondisi' => $request->kondisi,
                'inventarisir' => $request->inventarisir,
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
        $lahan->inventarisir = $request->input('inventarisir');
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