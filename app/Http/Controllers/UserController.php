<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function tampilkanPengguna()
    {
        $roles = Role::all();
        if (request()->ajax()) {
            $user = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.nip', 'users.alamat', 'users.email', 'users.role_id', 'roles.role_name')
            ->get();
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $tombol = "<button data-id='$row->id' data-name='$row->name' onclick='deleteDataUser(this)' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i>Hapus</button>";
                    return $tombol;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.datatablepengguna',  ['roles' => $roles]);
    }

    public function simpanpengguna(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'alamat' => 'required',
                    'password' => 'required|string|min:8',
                    'role_id' => 'required|exists:roles,id',
                ],
                [
                    'name.required' => 'Nama pengguna harus diisi',
                    'email.unique' => 'Email sudah ada. Silahkan gunakan email lainnya',
                    'email.required' => 'Alamat email harus diisi',
                    'alamat.required' => 'Alamat harus diisi',
                    'password.min' => 'Kata sandi minimal harus :min karakter',
                    'password.required' => 'Kata sandi harus diisi',
                    'role_id' => 'Silahkan pilih role pengguna',
                ]
            );

            if ($validator->fails()) {
                $errors = $validator->errors();
                $errorMessage = $errors->first();

                return response()->json([
                    'errors' => $errorMessage,
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            if ($user) {
                return response()->json(['message' => 'Data pengguna berhasil ditambahkan.'], 200);
            } else {
                return response()->json(['message' => 'Gagal menambahkan data pengguna.'], 500);
            }
        }
    }

    public function hapuspengguna(Request $request, $id)
    {
        $user = User::findorfail($id);
        
        // Validasi jika pengguna yang akan dihapus bukanlah pengguna yang sedang aktif
        if ($user->id === auth()->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus pengguna sendiri.'
            ]);
        }
    
        if ($request->ajax()) {
            if ($user) {
                $user->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna ' . $user->name . ' berhasil dihapus.'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    } 
}
