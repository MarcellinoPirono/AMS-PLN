<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login()
    {
        // Alert::error('Gagal Login', 'Username atau Password Salah');
        return view('layouts.login');
    }

    public function authenticate(Request $request)
    {
        Alert::error('Gagal Login', 'Username atau Password Salah');
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        // if(Auth::attempt($credentials)){
        //     if(auth()->user()->username !== 'superadmin'){
        //         $request->session()->regenerate();
        //         return redirect()->intended('/po-khs');
        //     }

        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }
        if (Auth::attempt($credentials)) {
            // dd($credentials);


            if (auth()->user()->role === 'Supervisor' || auth()->user()->role === 'REN' ) {
                $request->session()->regenerate();
                Alert::success('Login Telah Berhasil', 'Selamat Datang di SIPAKAINGA '.$request->username.'');
                return redirect('/dashboard');

            } else if(auth()->user()->role === 'Keuangan'){
                $request->session()->regenerate();

                Alert::success('Login Telah Berhasil', 'Selamat Datang di SIPAKAINGA '.$request->username.'');
                return redirect('/dashboard');

            }
            else if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Manager' ){
                $request->session()->regenerate();
                Alert::success('Login Telah Berhasil', 'Selamat Datang di SIPAKAINGA '.$request->username.'');
                return redirect('/dashboard');
            }
        }

        else {
            Alert::error('Gagal Login', 'Username atau Password Salah');
        }

        return back();

    }

    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::toast('Logout Berhasil', 'info');

        return redirect('/login');
    }
}
