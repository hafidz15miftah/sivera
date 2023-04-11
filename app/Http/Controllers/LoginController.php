<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Untuk Melihat Halaman Login
    public function login_view(Request $request){

        return view('pages.login');
    }

    // Fungsi Validasi Login
    public function login(Request $request){
        $check = 0;

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->except(['_token']);

        $users = User::select('email')->get();

        foreach ($users as $user){
            if($user->email == $request->email){
                $check = 1;
            }
        }

        if ($check == 1){
            if(auth()->attempt($credential)){
                return redirect()->route('dashboard');
            }
            else{
                return redirect()->back()->withErrors(['msg' => 'Email/Kata Sandi Salah']);
            }
        }
        else{
            return redirect()->back()->withErrors(['msg' => 'Email/Kata Sandi Salah']);
        }

    }

}
