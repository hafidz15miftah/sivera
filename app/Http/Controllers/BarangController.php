<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\Ruang;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{

    //Untuk melihat halaman Data Barang
    // public function indeksbarang()
    // {
    //     $barang = DataBarangModel::latest()->get();
    //     return view('pages.datatablebarang', compact('datatablebarang'));
    // }

    //Menampilkan Tabel Data Barang Menggunakan Yajra DataTables
    public function tampilkanBarang()
    {
        $ruang = Ruang::all();
        if (request()->ajax()) {
            $barang = DataBarangModel::join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')->select('barangs.id', 'barangs.kode_barang', 'barangs.nama_barang', 'barangs.updated_at', 'barangs.ruang_id', 'ruangs.nama_ruang');
            return DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' onclick='lihatdata(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' onclick='lihatdatabarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_barang' onclick='deleteDataBarang(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('updated_at', function ($dataupdate) {
                    $formatdataupdate = Carbon::createFromFormat('Y-m-d H:i:s', $dataupdate->updated_at)->format('d-m-Y H:i:s');
                    return $formatdataupdate;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatablebarang', ['ruang' => $ruang]);
    }

    //Untuk melihat data barang
    public function lihatdata($id){
        $barang = DataBarangModel::findorfail($id);
        $ruang = Ruang::where('id',$barang->ruang_id)->pluck('nama_ruang');
        return response()->json([$barang,$ruang]);
    }


    public function updatebarang(Request $request, $id)
    {
        $barang = DataBarangModel::findorfail($id);

        $barang->nama_barang = $request->input('nama_barang');
        $barang->kode_barang = $request->input('kode_barang');
        $barang->ruang_id = $request->input('ruang_id');
        $barang->save();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diupdate!',
            'data' => $barang
        ]);
    }

    //Untuk menghapus data barang
    public function hapusbarang(Request $request, $id)
    {
        $barang = DataBarangModel::findorfail($id);
        if ($request->ajax()) {
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data barang ' . $barang->nama_barang . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    //Untuk menyimpan barang
    public function simpanbarang(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required',
                'kode_barang' => 'required|unique:barangs,kode_barang',
                'ruang_id' => 'required',
            ],[
                'nama_barang.required' => 'Nama barang harus diisi.',
                'kode_barang.required' => 'Kode barang harus diisi.',
                'kode_barang.unique' => 'Kode barang sudah digunakan.',
                'ruang_id.required' => 'Ruang harus dipilih.',
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
            $barang = [
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'ruang_id' => $request->ruang_id,
            ];

            DataBarangModel::create($barang);

            return response()->json([
                'success' => true,
                'message' => 'Data Barang Berhasil Disimpan!',
            ]);
        }
    }
}
