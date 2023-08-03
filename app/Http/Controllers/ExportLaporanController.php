<?php

namespace App\Http\Controllers;

use App\Models\DataAsetJalanModel;
use App\Models\DataAsetKendaraanModel;
use App\Models\DataAsetTanahModel;
use App\Models\DataBarangModel;
use App\Models\DetailBarangModel;
use App\Models\Kategori;
use App\Models\KondisiBarangModel;
use App\Models\LaporanModel;
use App\Models\Ruang;
use App\Models\VerifikasiLaporanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportLaporanController extends Controller
{
    public function cetak_stiker_all()
    {
        $stiker = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'details.inventarisir',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
        ->join('infos', 'details.info_id', '=', 'infos.id')
        ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
        ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
        ->get();
        $data = Pdf::loadView('pdf.stiker_kodebarang', ['data' => 'Daftar Inventaris Barang', 'stiker' => $stiker])->setPaper('A5');
        return $data->stream('semua-stiker.pdf');
    }

    public function cetak_laporan_perbulan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = Carbon::parse($bulan)->format('Y');

        $verifikasi = VerifikasiLaporanModel::select(
            'laporans.id',
            'laporans.nama_laporan',
            'laporans.tanggal_dilaporkan',
            'laporans.status',
            'laporans.keterangan',
            'infos.kode_detail'
        )
            ->join('infos', 'laporans.info_id', '=', 'infos.id')
            ->whereMonth('tanggal_dilaporkan', Carbon::parse($bulan)->format('m'))
            ->get();

        // Cek apakah data tersedia
        if ($verifikasi->isEmpty()) {
            // Data kosong, tampilkan notifikasi
            return response()->json(['status' => 'empty']);
        }
        $pdf = PDF::loadView('pdf.pelaporan_bulanan', ['verifikasi' => $verifikasi, 'bulan' => $bulan, 'tahun' => $tahun])->setPaper('A4');
        $fileContents = $pdf->output();

        $filename = 'laporan-bulanan.pdf';
        $filePath = public_path('storage/' . $filename);
        $fileUrl = asset('storage/' . $filename);

        file_put_contents($filePath, $fileContents);

        $response = [
            'url' => $fileUrl,
            'Content-Type' => 'application/pdf',
        ];

        return response()->json($response);
    }

    public function cetak_laporan_pertahun(Request $request)
    {
        $tahun = $request->input('tahun');

        $verifikasi = VerifikasiLaporanModel::select(
            'laporans.id',
            'laporans.nama_laporan',
            'laporans.tanggal_dilaporkan',
            'laporans.status',
            'laporans.keterangan',
            'infos.kode_detail'
        )
            ->join('infos', 'laporans.info_id', '=', 'infos.id')
            ->whereYear('tanggal_dilaporkan', $tahun)
            ->get();

        $pdf = Pdf::loadView('pdf.pelaporan_tahunan', ['verifikasi' => $verifikasi, 'tahun' => $tahun])->setPaper('A4');
        return $pdf->stream('laporan-tahunan.pdf', ['Content-Type' => 'application/pdf']);
    }

    public function cetak_semua_aset()
    {
        $lahan = DataAsetTanahModel::query()->get();
        $data = Pdf::loadView('pdf.aset_lahan_semua', ['data' => 'Daftar Inventaris Barang', 'lahan' => $lahan])->setPaper('A4', 'landscape');
        return $data->stream('semua-lahan.pdf');
    }

    public function cetak_jalan()
    {
        $jalan = DataAsetJalanModel::query()->get();
        $data = Pdf::loadView('pdf.aset_jalan_semua', ['data' => 'Daftar Inventaris Barang', 'jalan' => $jalan])->setPaper('A4', 'landscape');
        return $data->stream('semua-jalan.pdf');
    }

    public function cetak_kendaraan()
    {
        $kendaraan = DataAsetKendaraanModel::query()->get();
        $data = Pdf::loadView('pdf.aset_kendaraan_semua', ['data' => 'Daftar Inventaris Barang', 'kendaraan' => $kendaraan])->setPaper('A4', 'landscape');
        return $data->stream('semua-kendaraan.pdf');
    }

    public function cetak_semua_laporan()
    {
        $laporan = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'details.inventarisir',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->get();
        $data = Pdf::loadView('pdf.detail_barang_semua', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-semua.pdf');
    }

    public function cetak_barang_tahunini(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $laporan = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'details.inventarisir',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->whereYear('details.inventarisir', $currentYear) // Filter data for the current year
            ->get();

        $data = Pdf::loadView('pdf.detail_barang', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-tahunini.pdf');
    }

    public function cetak_laporan_bybarang(Request $request)
    {
        $selectedBarang =  $request->input('selected_barang');
        $laporan = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'details.inventarisir',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->where('details.info_id', '=', $selectedBarang)
            ->get();
        $data = Pdf::loadView('pdf.detail_barang', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-bybarang.pdf');
    }

    public function cetak_laporan_bytanggal(Request $request)
    {
        $selectedDate =  $request->input('selected_date');
        $tanggal = \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('Y-m-d');
        // dd($tanggal);
        $laporan = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'details.inventarisir',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->whereDate('details.tgl_perolehan', '=', $selectedDate)
            ->get();
        $data = Pdf::loadView('pdf.detail_barang', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-bytanggal.pdf');
    }

    public function cetak_laporan_byinventarisir(Request $request)
    {
        $selectedTahun = $request->input('selected_tahun');
        $laporan = DetailBarangModel::select(
            // Kode query lain ...
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->whereYear('details.inventarisir', $selectedTahun)
            ->get();
        $data = Pdf::loadView('pdf.detail_barang_byinventarisir', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan, 'selectedTahun' => $selectedTahun])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-byinventarisir.pdf');
    }

    //Cetak Barang berdasarkan ruangan 
    public function cetak_laporan_byruang(Request $request)
    {
        $ruangan =  $request->input('selected_ruang');

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
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->where('details.ruang_id', $ruangan)
            ->get();

        $ruang = Ruang::findorFail($ruangan);

        $data = Pdf::loadView('pdf.detail_barang_ruang', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan, 'nama_ruangan' => $ruang])->setPaper('A4', 'landscape');
        return $data->stream('detailbarang-byruang.pdf');
    }

    public function cetak_berita_acara(Request $request)
    {
        $selectedBarang =  $request->input('barang_dipilih');
        $berita = DetailBarangModel::select(
            'details.id',
            'details.tgl_perolehan',
            'details.merk',
            'details.sumber',
            'details.harga',
            'details.keterangan',
            'infos.kode_detail',
            'infos.kondisi',
            'barangs.nama_barang',
            'barangs.kode_barang',
            'ruangs.nama_ruang'
        )
            ->join('infos', 'details.info_id', '=', 'infos.id')
            ->join('barangs', 'infos.barang_id', '=', 'barangs.id')
            ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
            ->where('details.info_id', '=', $selectedBarang)
            ->get();
        $data = Pdf::loadView('pdf.berita_acara', ['data' => 'Daftar Inventaris Barang', 'berita' => $berita])->setPaper('A4', 'potrait');
        // $data->render();
        return $data->stream('berita_acara.pdf', ['Attachment' => false]);
    }

    public function cetak_tanah_byinventarisir(Request $request)
    {
        $selectedTahun = $request->input('selected_tahun');
        $lahan = DataAsetTanahModel::whereYear('inventarisir', $selectedTahun)->get();
        $data = Pdf::loadView('pdf.aset_tanah_byinventarisir', ['data' => 'Daftar Inventaris Barang', 'lahan' => $lahan, 'selectedTahun' => $selectedTahun])->setPaper('A4', 'landscape');
        return $data->stream('tanah_selected_tahun.pdf');
    }

    public function cetak_jalan_byinventarisir(Request $request)
    {
        $selectedTahun = $request->input('selected_tahun');
        $jalan = DataAsetJalanModel::whereYear('inventarisir', $selectedTahun)->get();
        $data = Pdf::loadView('pdf.aset_jalan_byinventarisir', ['data' => 'Daftar Inventaris Barang', 'jalan' => $jalan, 'selectedTahun' => $selectedTahun])->setPaper('A4', 'landscape');
        return $data->stream('jalan_selected_tahun.pdf');
    }

    public function cetak_kendaraan_byinventarisir(Request $request)
    {
        $selectedTahun = $request->input('selected_tahun');
        $kendaraan = DataAsetKendaraanModel::whereYear('inventarisir', $selectedTahun)->get();
        $data = PDF::loadView('pdf.aset_kendaraan_byinventarisir', ['data' => 'Daftar Inventaris Barang', 'kendaraan' => $kendaraan, 'selectedTahun' => $selectedTahun])->setPaper('A4', 'landscape');
        return $data->stream('kendaraan_selected_tahun.pdf');
    }

    public function cetak_tanah_tahunini(Request $request)
    {
        $selectedTahun = Carbon::now()->year;
        $lahan = DataAsetTanahModel::whereYear('inventarisir', $selectedTahun)->get();
        $data = PDF::loadView('pdf.aset_lahan', ['data' => 'Daftar Inventaris Barang', 'lahan' => $lahan])->setPaper('A4', 'landscape');
        return $data->stream('tanah_tahunini.pdf');
    }

    public function cetak_jalan_tahunini(Request $request)
    {
        $selectedTahun = Carbon::now()->year;
        $lahan = DataAsetTanahModel::whereYear('inventarisir', $selectedTahun)->get();
        $data = PDF::loadView('pdf.aset_jalan', ['data' => 'Daftar Inventaris Barang', 'lahan' => $lahan])->setPaper('A4', 'landscape');
        return $data->stream('jalan_tahunini.pdf');
    }
}
