<?php

namespace App\Http\Controllers;

use App\Models\DataPenggunaModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Untuk melihat halaman Tabel Data Pengguna
    public function indekspengguna()
    {
        return view('pages.datatablepengguna');
    }

    //Untuk melihat tabel pengguna
    public function tampilpengguna()
    {
        $users = DataPenggunaModel::join('roles', 'roles.id', '=', 'users.role_id')->get();
        return view('pages.datatablepengguna', ['users' => $users]);
    }

    
}
