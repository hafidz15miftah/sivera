<?php

namespace App\Http\Controllers;

use App\Models\DataBarangModel;
use App\Models\LaporanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportLaporanContoller extends Controller
{
    //Cetak Semua Barang
    public function cetak_semua_barang(){
        $barang = DataBarangModel::join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')->get();
        $nama = "SEMUA RUANGAN";
        $data = Pdf::loadView('pdf.barang_pdf', ['data' => 'Daftar Inventaris Barang', 'barang' => $barang, 'nama' => $nama]);
        return $data->stream('semua-barang.pdf');
    }

    public function cetak_semua_laporan(){
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
        $data = Pdf::loadView('pdf.laporan', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('laporan.pdf');
    }

    public function cetak_laporan_bybarang(Request $request){
        $selectedBarang =  $request->input('selected_barang');
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
        ->where('laporan.barang_id', '=', $selectedBarang)
        ->get();
        $data = Pdf::loadView('pdf.laporan', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('laporan.pdf');
    }

    public function cetak_laporan_bytanggal(Request $request){
        $selectedDate =  $request->input('selected_date');
        $tanggal = \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('Y-m-d');
        // dd($tanggal);
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
        ->whereDate('laporan.tgl_pembelian', '=', $selectedDate)
        ->get();
        $data = Pdf::loadView('pdf.laporan', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan])->setPaper('A4', 'landscape');
        return $data->stream('laporan.pdf');
    }

    //Cetak Barang berdasarkan ruangan dan bulan
    public function cetak_barang_ruangan(Request $request){
        $ruangan =  $request->input('ruangan_id');
        $tanggal = $request->input('selected_month');
        $ubahformat = \Carbon\Carbon::parse($tanggal)->startOfMonth();
        $bulan = $ubahformat->month;
        $tahun =  $ubahformat->year;

        $barang = DataBarangModel::join('ruangs', 'barang.ruang_id', '=', 'ruangs.id')->where('barang.ruang_id', $ruangan)->whereMonth('barang.tanggal', $bulan)->whereYear('barang.tanggal', $tahun)->get();

        $data = Pdf::loadView('pdf.barang_pdf', ['data' => 'Daftar Inventaris Barang', 'barang' => $barang]);
        return $data->stream('laporan.pdf');
    }

    public function cetak_berita_acara(Request $request){
        $selectedBarang =  $request->input('barang_dipilih');
        $berita = LaporanModel::select(
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
        ->where('laporan.barang_id', '=', $selectedBarang)
        ->get();

        $ruring = LaporanModel::select(DB::raw('SUM(rusak_ringan) as totRuring'))->where('laporan.barang_id', $selectedBarang)->first();
        $ruber = LaporanModel::select(DB::raw('SUM(rusak_berat) as totalRuber'))->where('laporan.barang_id', $selectedBarang)->first();
        $rusak_ringan = $ruring->totRuring;
        $rusak_berat = $ruber->totalRuber;

        $data = Pdf::loadView('pdf.berita_acara', ['data' => 'Daftar Inventaris Barang', 'berita' => $berita, 'rusak_ringan' => $rusak_ringan, 'rusak_berat' => $rusak_berat])->setPaper('A4', 'potrait');
        // $data->render();
        return $data->download('berita_acara.pdf', ['Attachment' => false]);
    }
}