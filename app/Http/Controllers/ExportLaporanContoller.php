<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use App\Models\DataBarangModel;
use App\Models\LaporanModel;
use App\Models\Ruang;
use App\Models\VerifikasiLaporanModel;
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

    public function cetak_stiker_all(){
        $stiker = DataBarangModel::join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')->get();
        $data = Pdf::loadView('pdf.kode_barang', ['data' => 'Daftar Inventaris Barang', 'stiker' => $stiker])->setPaper('A5');;
        return $data->stream('cetak-stiker-all.pdf');
    }

    public function cetak_stiker_one(Request $request){
        $selectedBarang =  $request->input('selected_barang');
        $stiker = DataBarangModel::select(
            'barangs.kode_barang',
            'barangs.nama_barang',
            'ruangs.nama_ruang',
        )
        ->join('ruangs', 'barangs.ruang_id', '=', 'ruangs.id')
        ->where('.barang_id', '=', $selectedBarang)
        ->get();
        $data = Pdf::loadView('pdf.kode_barang', ['data' => 'Daftar Inventaris Barang', 'stiker' => $stiker])->setPaper('A5');;
        return $data->stream('cetak-stiker-bybarang.pdf');
    }

    public function cetak_verifikasi_all(){
        $verifikasi = VerifikasiLaporanModel::all();
        $data = Pdf::loadView('pdf.laporan_pdf', ['data' => 'Daftar Inventaris Barang', 'verifikasi' => $verifikasi])->setPaper('A4');;
        return $data->stream('cetak-verifikasi-all.pdf');
    }

    public function cetak_semua_aset(){
        $lahan = DataAsetTanahModel::query()->get();
        $data = Pdf::loadView('pdf.lahan_pdf', ['data' => 'Daftar Inventaris Barang', 'lahan' => $lahan]);
        return $data->stream('semua-aset.pdf');
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

//Cetak Barang berdasarkan ruangan 
    public function cetak_laporan_byruang(Request $request){
        $ruangan =  $request->input('selected_ruang');

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
        ->where('laporan.ruang_id', $ruangan)
        ->get();

        $ruang = Ruang::findorFail($ruangan);

        $data = Pdf::loadView('pdf.laporanbyruang', ['data' => 'Daftar Inventaris Barang', 'laporan' => $laporan, 'nama_ruangan' => $ruang])->setPaper('A4', 'landscape');
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
