<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class BarangController extends Controller
{

    //Untuk melihat halaman Data Barang
    public function indeksbarang()
    {
        $barang = DataBarangModel::latest()->get();
        return view('pages.datatablebarang', compact('datatablebarang'));
    }

    //Untuk menampilkan tabel Barang
    // public function tampilbarang()
    // {
    //     $barang = DataBarangModel::all();
    //     $ruang = Ruang::all();
    //     return view('pages.datatablebarang', ['barang' => $barang, 'ruang' => $ruang]);
    // }

    //Menampilkan Tabel Data Barang Menggunakan Yajra DataTables
    public function tampilkanBarang()
    {
        $ruang = Ruang::all();
        if (request()->ajax()) {
            $barang = DataBarangModel::join('ruangs', 'barang.ruang_id', '=', 'ruangs.id')->select('barang.id', 'barang.tanggal', 'barang.kode_barang', 'barang.kondisi', 'barang.nama_barang', 'barang.jumlah', 'barang.updated_at', 'barang.ruang_id', 'ruangs.nama_ruang');
            return DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">Lihat</a>';
                    $tombol = $tombol . '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_barang' onclick='deleteData(this)' class='btn btn-danger btn-sm'>Hapus</button>";

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

    //Untuk menampilkan data ruang saat menambah data barang
    // public function tambahbarang()
    // {
    //     $ruang = Ruang::all();
    //     // dd($ruang);
    //     return view('partials.barangmodal', compact('ruang'));
    // }

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
        // return redirect()->route('tampilbarang')->with('toast_success', 'Barang Berhasil Dihapus!');
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */

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
                'message' => 'Data Berhasil Disimpan!',
            ]);
        }
    }

    //Untuk menyimpan barang via halaman
    // public function simpanbarang(Request $request)
    // {
    //     $barang = DataBarangModel::create([
    //         'nama_barang' => $request->nama_barang,
    //         'tanggal' => $request->tanggal,
    //         'kode_barang' => $request->kode_barang,
    //         'kondisi' => $request->kondisi,
    //         'nama_barang' => $request->nama_barang,
    //         'jumlah' => $request->jumlah,
    //         'ruang_id' => $request->ruang,
    //     ]);

    //     // $ruang = new Ruang;
    //     // $ruang->ruang_id = $barang->id;
    //     // dd($barang);

    //     return redirect()->route('tampilbarang')->withToastSuccess('Barang Berhasil Ditambahkan!');
    // }
}
