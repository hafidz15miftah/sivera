<?php

namespace App\Http\Controllers;

use App\Models\DataPenggunaModel;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function tampilkanPengguna()
    {
        $role = Role::all();
        if (request()->ajax()) {
            $user = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.name', 'users.nip', 'users.alamat', 'users.email', 'users.role_id', 'roles.role_name')
                ->get();
                
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' class='btn btn-warning btn-sm text-white' style='margin-right: 3px;' onclick='updatedatalahan(this)'><i class='fa fa-pencil-square-o'></i>Ubah</button>";
                    $tombol = $tombol . "<button data-id='$row->id' data-name='$row->name' onclick='deleteDataLahan(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
    
                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatablepengguna');
    }    
}
