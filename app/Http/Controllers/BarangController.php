<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\Kategori;
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
    //Menampilkan Tabel Data Barang Menggunakan Yajra DataTables
    public function tampilkanBarang()
    {
        $ruang = Ruang::all();
        $kategori = Kategori::all();
        if (request()->ajax()) {
            $barang = DataBarangModel::select(
                'barangs.id',
                'barangs.kode_barang',
                'barangs.nama_barang',
                'kategoris.nama_kategori',
                'kategoris.kode_kategori',
                'ruangs.nama_ruang'
            )
                ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
                ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
                ->get();
            return DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='width:50px;' onclick='lihatdata(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:50px;' onclick='lihatdatabarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_barang' onclick='deleteDataBarang(this)' class='btn btn-danger btn-sm' style='margin-top: 3px; width:50px;'><i class='fa fa-trash'></i>Hapus</button>";
                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatablebarang', ['ruang' => $ruang, 'kategori' => $kategori]);
    }

    public function getKode(Request $request)
    {
        $kategoriId = $request->input('kategori_id');
        $ruangId = $request->input('ruang_id');

        $kodeKategori = '';
        $kodeRuang = '';

        if ($kategoriId) {
            $kategori = Kategori::find($kategoriId);
            if ($kategori) {
                $kodeKategori = $kategori->kode_kategori;
            }
        }

        if ($ruangId) {
            $ruang = Ruang::find($ruangId);
            if ($ruang) {
                $kodeRuang = $ruang->kode_ruang;
            }
        }

        return response()->json([
            'kode_kategori' => $kodeKategori,
            'kode_ruang' => $kodeRuang
        ]);
    }

    //Untuk melihat data barang
    public function lihatdata($id){
        $barang = DataBarangModel::findorfail($id);
        $kategori = Kategori::where('id',$barang->kategori_id)->pluck('nama_kategori');
        $ruang = Ruang::where('id',$barang->ruang_id)->pluck('nama_ruang');
        return response()->json([$barang,$ruang,$kategori]);
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
                'kategori_id' => 'required',
                'ruang_id' => 'required',
            ],[
                'nama_barang.required' => 'Nama barang harus diisi.',
                'kode_barang.required' => 'Kode barang harus diisi.',
                'kategori_id' => 'Kategori aset harus dipilih',
                'kode_barang.unique' => 'Kode barang sudah digunakan.',
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
                'kategori_id' => $request->kategori_id,
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
