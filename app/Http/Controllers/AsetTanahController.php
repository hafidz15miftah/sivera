<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AsetTanahController extends Controller
{
    public function tampilkanLahan()
    {
        if (request()->ajax()) {
            $lahan = DataAsetTanahModel::all();
            return DataTables::of($lahan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' onclick='lihatlahan(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' onclick='lihatdatalahan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_barang' onclick='deleteDataLahan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";

                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatabletanah');
    }
    //Untuk melihat halaman Tabel Data Aset
    // public function indekstanah()
    // {
    //     return view('pages.datatabletanah');
    // }

    //Untuk melihat tabel aset
    // public function tampiltanah()
    // {
    //     $tanah = DataAsetTanahModel::select('*')->get();
    //     return view('pages.datatabletanah', ['tanah' => $tanah]);
    // }
}