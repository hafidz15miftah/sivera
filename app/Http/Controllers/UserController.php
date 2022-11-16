<?php

namespace App\Http\Controllers;

use App\Models\DataPenggunaModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Untuk melihat halaman Tabel Data Pengguna
    public function indekspengguna()
    {
        return view('pages.users');
    }

    //Untuk melihat tabel pengguna
    public function tampilpengguna()
    {
        $users = DataPenggunaModel::select('*')->get();
        return view('pages.users', ['users' => $users]);
    }
}
