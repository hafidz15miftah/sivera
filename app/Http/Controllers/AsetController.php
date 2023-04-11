<?php

namespace App\Http\Controllers;

use App\Models\DataAsetModel;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    //Untuk melihat halaman Tabel Data Aset
    public function indeksaset()
    {
        return view('pages.datatableaset');
    }

    //Untuk melihat tabel aset
    public function tampilaset()
    {
        $aset = DataAsetModel::select('*')->get();
        return view('pages.datatableaset', ['aset' => $aset]);
    }
}