<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    //
    public function tampilkanKategori()
    {
        if (request()->ajax()) {
            $kategori = Kategori::all();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-primary btn-sm text-white' style='margin-right: 3px;' onclick='lihatdata(this)'><i class='fa fa-eye'></i>Lihat</button>";
                    $tombol = $tombol . "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='lihatdatabarang(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->nama_kategori' onclick='deleteDataBarang(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.categories');
    }
}
