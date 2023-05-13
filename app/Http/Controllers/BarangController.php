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
    public function indeksbarang()
    {
        $barang = DataBarangModel::latest()->get();
        return view('pages.datatablebarang', compact('datatablebarang'));
    }

    //Menampilkan Tabel Data Barang Menggunakan Yajra DataTables
    public function tampilkanBarang()
    {
        $ruang = Ruang::all();
        if (request()->ajax()) {
            $barang = DataBarangModel::join('ruangs', 'barang.ruang_id', '=', 'ruangs.id')->select('barang.id', 'barang.tanggal', 'barang.kode_barang', 'barang.kondisi', 'barang.nama_barang', 'barang.jumlah', 'barang.updated_at', 'barang.ruang_id', 'ruangs.nama_ruang');
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
                ->editColumn('tanggal', function ($datatanggal) {
                    $formatdatatanggal = Carbon::createFromFormat('Y-m-d', $datatanggal->tanggal)->format('d-m-Y');
                    return $formatdatatanggal;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatablebarang', ['ruang' => $ruang]);
    }

    //Untuk melihat data barang
    public function lihatdata($id){
        $barang = DataBarangModel::findorfail($id);
        return response()->json($barang);
    }

    public function cetakbarang(){
        $data = Pdf::loadView('pdf.barang_pdf', ['data' => 'Daftar Inventaris Barang']);
        return $data->download('laporan.pdf');
    }

    public function updatebarang(Request $request, $id)
    {
        $barang = DataBarangModel::findorfail($id);

        $barang->nama_barang = $request->input('nama_barang');
        $barang->tanggal = $request->input('tanggal');
        $barang->kode_barang = $request->input('kode_barang');
        $barang->kondisi = $request->input('kondisi');
        $barang->jumlah = $request->input('jumlah');
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
                'tanggal' => 'required',
                'kode_barang' => 'required',
                'kondisi' => 'required',
                'jumlah' => 'required',
                'ruang_id' => 'required',
            ]);

            //Cek Validasi
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Membuat Data
            $barang = DataBarangModel::create([
                'nama_barang' => $request->nama_barang,
                'tanggal' => $request->tanggal,
                'kode_barang' => $request->kode_barang,
                'kondisi' => $request->kondisi,
                'jumlah' => $request->jumlah,
                'ruang_id' => $request->ruang_id,
            ]);

            $ruang = new Ruang;
            $ruang->ruang_id = $barang->id;

            return response()->json([
                'success' => true,
                'message' => 'Data Barang Berhasil Disimpan!',
            ]);
        }
    }
}
