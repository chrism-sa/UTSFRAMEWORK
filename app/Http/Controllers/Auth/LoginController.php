<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, tentukan dashboard berdasarkan peran pengguna
            if (Auth::user()->isAdmin()) {
                // Jika pengguna adalah admin, arahkan ke dashboard admin
                return redirect()->route('admin.dashboard');
            } else {
                // Jika pengguna adalah user, arahkan ke dashboard user
                return redirect()->route('user.dashboard');
            }
        }
    
        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
