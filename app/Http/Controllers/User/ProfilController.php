<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna terotentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman profil.');
        }

        // Jika terotentikasi, ambil data pengguna
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }
}
