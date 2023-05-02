<?php

namespace App\Http\Controllers;

use App\Models\DataRuangModel;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function tampilruangan()
    {
        $ruangan = Ruang::select('*')->get();
        return view('pages.datatableruangan', ['ruangan' => $ruangan]);
    }

    public function tambahruangan()
    {
        $ruangan = Ruang::all();
        return view('pages.addruangan', compact('ruangan'));
    }

    public function simpanruangan(Request $request)
    {
        $ruangan = Ruang::create([
            'nama_ruang' => $request->nama_ruang
        ]);

        return redirect()->route('tampilruangan')->withToastSuccess('Ruangan Berhasil Ditambahkan!');;
    }
}

