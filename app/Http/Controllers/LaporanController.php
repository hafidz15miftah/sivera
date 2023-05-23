<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\LaporanModel;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{

    public function tampilkanLaporan()
    {
        $barang = DataBarangModel::all();
        $ruang = Ruang::all();

        if (request()->ajax()) {
            $laporan = LaporanModel::select(
                'laporan.id',
                'laporan.tgl_pembelian',
                'laporan.sumber_dana',
                'laporan.baik',
                'laporan.rusak_ringan',
                'laporan.rusak_berat',
                'laporan.jumlah',
                'laporan.keterangan',
                'barangs.kode_barang',
                'barangs.nama_barang',
                'ruangs.nama_ruang'
            )
            ->join('barangs', 'laporan.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->get();
            return DataTables::of($laporan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' onclick='lihatdata(this)'><i class='fa fa-eye'></i>Lihat</button>";
                $tombol .= "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' onclick='lihatdatabarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";

                return $tombol;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('pages.laporan', compact('barang','ruang'));
    }

    public function simpanLaporan(Request $request){
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'barang_id' => 'required|unique:laporan,barang_id',
                'tgl_pembelian' => 'required',
                'sumber_dana' => 'required',
                'baik' => 'required|numeric',
                'rusak_ringan' => 'required|numeric',
                'rusak_berat' => 'required|numeric',
                'keterangan' => 'nullable|min:4',
            ],[
                'barang_id.required' => 'Nama barang harus di pilih.',
                'barang_id.unique' => 'Barang sudah dilaporkan, silahkan gunakan fitur update.',
                'tgl_pembelian.required' => 'Tanggal Pembelian harus diisi.',
                'sumber_dana.required' => 'Sumber Dana harus diisi.',
                'baik.required' => 'Kolom Baik harus diisi.',
                'rusak_ringan.required' => 'Kolom Rusak Ringan harus diisi.',
                'rusak_berat.required' => 'Kolom Rusak Berat harus diisi.',
                'keterangan.min' => 'Keterangan harus memiliki setidaknya :min karakter.',
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
            $data = [
                'barang_id' => $request->barang_id,
                'tgl_pembelian' => $request->tgl_pembelian,
                'sumber_dana' => $request->sumber_dana,
                'baik' => $request->baik,
                'rusak_ringan' => $request->rusak_ringan,
                'rusak_berat' => $request->rusak_berat,
                'jumlah' => $request->baik + $request->rusak_ringan + $request->rusak_berat,
                'keterangan' => $request->keterangan,
            ];

            LaporanModel::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Laporan data Barang Berhasil Disimpan!',
            ]);
        }
    }
}