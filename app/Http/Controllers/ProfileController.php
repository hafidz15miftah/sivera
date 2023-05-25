<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function lihatprofil()
    {
        $user = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->select('roles.role_name', 'users.id', 'users.role_id', 'users.name', 'users.email', 'users.nip', 'users.alamat')
            ->where('users.id', '=', auth()->user()->id)
            ->get();
        return view('pages.profile', compact('user'));
    }

    public function editprofil(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'nip' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'name' => 'required',
            'alamat' => 'required',
            'password' => 'nullable',
            'new_password' => 'nullable|min:5',
        ], [
            'name.required' => 'Nama harus diisi',
            'nip.required' => 'NIP harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah digunakan',
            'alamat.required' => 'Alamat harus diisi',
            'new_password.min' => 'Kata Sandi harus diisi minimal 5 karakter',
        ],);

        if ($validated->fails()) {
            $errorMessage = $validated->messages()->all()[0];
            return redirect()->back()->with([
                'error' => $errorMessage,
                'showToast' => true,
            ])->withInput();
        }

        $user = User::find($id);

        $user->nip = $request['nip'];
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->alamat = $request['alamat'];

        if ($request->password != null) {
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->with([
                    'error' => 'Kata Sandi Salah',
                    'showToast' => true,
                ])->withInput();
            }

            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        return redirect()->route('index')->with(['success' => 'Profil berhasil diupdate', 'tampilkanBerhasil' => true]);
    }
}
