<?php

namespace App\Http\Controllers;

use App\Models\DataAsetKendaraanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AsetKendaraanController extends Controller
{
    public function tampilkanKendaraan()
    {
        if (request()->ajax()) {
            $jalan = DataAsetKendaraanModel::select(
                'kendaraans.id',
                'kendaraans.nama_kendaraan',
                'kendaraans.plat',
                'kendaraans.merk',
                'kendaraans.tipe',
                'kendaraans.kondisi',
                'kendaraans.inventarisir',
                'kendaraans.keterangan',
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
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='width:50px;' onclick='lihatdatakendaraan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:50px;' onclick='updatedatakendaraan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_kendaraan' onclick='deleteDataKendaraan(this)' class='btn btn-danger btn-sm' style='margin-top: 3px; width:50px;'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('inventarisir', function ($row) {
                    return \Carbon\Carbon::parse($row->inventarisir)->locale('id')->translatedFormat('l, d F Y');
                })
                ->rawColumns(['aksi', 'kondisi'])
                ->make(true);
        }
        return view('pages.datatablekendaraan');
    }

    public function simpankendaraan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'nama_kendaraan' => 'required',
                    'plat' => 'required',
                    'tgl_pembelian' => 'required',
                    'merk' => 'required',
                    'tipe' => 'required',
                    'kondisi' => 'required',
                    'inventarisir' => 'required',
                    'keterangan' => 'nullable|min:4'
                ],
                [
                    'nama_kendaraan.required' => 'Nama kendaraan harus diisi.',
                    'plat.required' => 'Nomor plat kepolisian harus diisi.',
                    'tgl_pembelian.required' => 'Tanggal pembelian harus dipilih.',
                    'merk.required' => 'Merk kendaraan harus diisi.',
                    'tipe.required' => 'Tipe kendaraan harus diisi.',
                    'kondisi.required' => 'Silahkan pilih kondisi kendaraan',
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
            $kendaraan = [
                'nama_kendaraan' => $request->nama_kendaraan,
                'plat' => $request->plat,
                'tgl_pembelian' => $request->tgl_pembelian,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'kondisi' => $request->kondisi,
                'inventarisir' => $request->inventarisir,
                'keterangan' => $request->keterangan,
            ];

            DataAsetKendaraanModel::create($kendaraan);

            return response()->json([
                'success' => true,
                'message' => 'Data Kendaraan Berhasil Disimpan!',
            ]);
        }
    }

    public function lihatkendaraan($id){
        $kendaraan = DataAsetKendaraanModel::findorfail($id);
        return response()->json([$kendaraan]);
    }

    public function updatekendaraan(Request $request, $id)
    {
        $kendaraan = DataAsetKendaraanModel::findorfail($id);
        $kendaraan->nama_kendaraan = $request->input('nama_kendaraan');
        $kendaraan->plat = $request->input('plat');
        $kendaraan->tgl_pembelian = $request->input('tgl_pembelian');
        $kendaraan->merk = $request->input('merk');
        $kendaraan->tipe = $request->input('tipe');
        $kendaraan->kondisi = $request->input('kondisi');
        $kendaraan->inventarisir = $request->input('inventarisir');
        $kendaraan->keterangan = $request->input('keterangan');
        $kendaraan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil diupdate!',
            'data' => $kendaraan
        ]);
    }

    public function hapuskendaraan(Request $request, $id)
    {
        $kendaraan = DataAsetKendaraanModel::findorfail($id);
        if ($request->ajax()) {
            if ($kendaraan) {
                $kendaraan->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data jalan ' . $kendaraan->nama_kendaraan . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }
}
