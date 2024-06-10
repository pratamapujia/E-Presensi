<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['pesan' => 'NIK / Password salah']);
        }
    }

    public function prosesLogout()
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    // Admin
    public function prosesLoginAdmin(Request $request)
    {
        $remember = $request->has('remember');

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('/panel/dashboard');
        } else {
            return redirect('/panel')->with(['pesan' => 'Email / Password salah']);
        }
    }

    public function prosesLogoutAdmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
}
