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
        $kategori = Kategori::all();
        if (request()->ajax()) {
            $lahan = DataAsetTanahModel::select(
                'tanah.id',
                'tanah.nama_obyek',
                'tanah.alamat',
                'tanah.no_sertifikat',
                'tanah.luas',
                'tanah.kondisi',
                'tanah.keterangan',
                'kategoris.nama_kategori',
            )
            ->join('kategoris', 'tanah.kategori_id', '=', 'kategoris.id')
            ->get();
            return DataTables::of($lahan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='margin-right: 3px;' onclick='lihatdatalahan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='updatedatalahan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_obyek' onclick='deleteDataLahan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->rawColumns(['aksi', 'kondisi'])
                ->make(true);
        }
        return view('pages.datatabletanah', ['kategori' => $kategori]);
    }

    //Untuk menyimpan barang
    public function simpanlahan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'kategori_id' => 'required',
                'nama_obyek' => 'required',
                'no_sertifikat' => 'required|unique:tanah,no_sertifikat',
                'luas' => 'required|numeric',
                'alamat' => 'required',
                'kondisi' => 'required',
                'keterangan' => 'nullable|min:4'
            ],[
                'kategori_id.required' => 'Kategori harus dipilih',
                'nama_obyek.required' => 'Nama obyek harus diisi.',
                'no_sertifikat.required' => 'Nomor sertifikat harus diisi.',
                'no_sertifikat.unique' => 'Nomor sertifikat sama dengan data yang sudah ada.',
                'luas.unique' => 'Kolom luas harus diisi.',
                'luas.numeric' => 'Kolom luas harus berupa angka.',
                'alamat.required' => 'Alamat harus diisi.',
                'kondisi.required' => 'Silahkan pilih kondisi tanah',
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
                'kategori_id' => $request->kategori_id,
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
        $lahan->kategori_id = $request->input('kategori_id');
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