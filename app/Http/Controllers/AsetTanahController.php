<?php

namespace App\Http\Controllers;

use App\Models\DataAsetTanahModel;
use Illuminate\Http\Request;

class AsetTanahController extends Controller
{
    //Untuk melihat halaman Tabel Data Aset
    public function indekstanah()
    {
        return view('pages.datatabletanah');
    }

    //Untuk melihat tabel aset
    public function tampiltanah()
    {
        $tanah = DataAsetTanahModel::select('*')->get();
        return view('pages.datatabletanah', ['tanah' => $tanah]);
    }
}