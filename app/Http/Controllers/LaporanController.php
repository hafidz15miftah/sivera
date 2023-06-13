<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\DetailBarangModel;
use App\Models\KondisiBarangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{

    public function tampilkanLaporan()
    {
        $barang = DataBarangModel::all();
        $info = KondisiBarangModel::all();
        $ruang = Ruang::all();
        if (request()->ajax()) {
            $laporan = DetailBarangModel::select(
                'details.id',
                'details.tgl_perolehan',
                'details.merk',
                'details.sumber',
                'details.harga',
                'details.keterangan',
                'infos.kode_detail',
                'infos.kondisi',
                'barangs.nama_barang',
                'kategoris.id as kategori_id',
                'kategoris.nama_kategori',
                'ruangs.nama_ruang'
            )
                ->join('infos', 'details.info_id', '=', 'infos.id')
                ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
                ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
                ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
                ->get();
            return DataTables::of($laporan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='width:50px;' onclick='lihatlapbar(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol .= "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-top: 3px; width:50px;' onclick='updateDetailBarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol .= "<button data-id='$row->id' class='btn btn-danger btn-sm text-white' style='margin-top: 3px; width:50px;' onclick='deleteDetailBarang(this)'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->editColumn('tgl_perolehan', function ($row) {
                    return \Carbon\Carbon::parse($row->tgl_perolehan)->locale('id')->translatedFormat('l, d F Y');
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.detailbarang', compact('barang', 'info', 'ruang'));
    }

    public function simpanLaporan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'info_id' => 'required|unique:details,info_id',
                    'tgl_perolehan' => 'required',
                    'sumber' => 'required',
                    'merk' => 'required',
                    'harga' => 'required',
                ],
                [
                    'info_id.required' => 'Kode barang harus di pilih',
                    'info_id.unique' => 'Kode barang sudah dilaporkan, silahkan melakukan ubah data pada tabel data',
                    'tgl_perolehan.required' => 'Tanggal perolehan harus diisi',
                    'sumber.required' => 'Sumber perolehan harus dipilih',
                    'merk.required' => 'Merk harus diisi',
                    'harga.required' => 'Harga barang harus diisi',
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

            $kondisiBarang = KondisiBarangModel::findOrFail($request->info_id);

            // Create Data
            $data = [
                'info_id' => $kondisiBarang->id,
                'barang_id' => $kondisiBarang->barang_id,
                'ruang_id' => $kondisiBarang->ruang_id,
                'tgl_perolehan' => $request->tgl_perolehan,
                'merk' => $request->merk,
                'sumber' => $request->sumber,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ];

            DetailBarangModel::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Detail data Barang Berhasil Disimpan!',
            ]);
        }
    }

    //Untuk menghapus detail barang
    public function hapuslapbar(Request $request, $id)
    {
        $barang = DetailBarangModel::findorfail($id);
        if ($request->ajax()) {
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Detail barang berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    public function lihatlapbar($id)
    {
        $laporan = DetailBarangModel::findorfail($id);
        $ruang = Ruang::where('id', $laporan->ruang_id)->pluck('nama_ruang');
        $namabar = DataBarangModel::where('id', $laporan->barang_id)->pluck('nama_barang');
        $kodbar = KondisiBarangModel::where('id', $laporan->info_id)->pluck('kode_detail');
        $kondisi = KondisiBarangModel::where('id', $laporan->info_id)->pluck('kondisi');
        return response()->json([$laporan, $ruang, $namabar, $kodbar, $kondisi]);
    }

    public function updatedetailbar(Request $request, $id)
    {
        $laporan = DetailBarangModel::findorfail($id);

        $laporan->tgl_perolehan = $request->input('tgl_perolehan');
        $laporan->sumber = $request->input('sumber');
        $laporan->merk = $request->input('merk');
        $laporan->harga = $request->input('harga');
        $laporan->keterangan = $request->input('keterangan');
        $laporan->save();

        return response()->json([
            'success' => true,
            'message' => 'Detail barang berhasil diupdate!',
            'data' => $laporan
        ]);
    }
}
