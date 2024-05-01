<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::all();
    return view('admin.notifikasi', ['notifications' => $notifications]);
}
    public function getUserNotifications()
    {
        // Pastikan pengguna sudah login
        if(Auth::check()) {
            // Ambil notifikasi untuk pengguna yang sedang login
            $userNotifications = Auth::user()->notifications;
            
            // Ubah format notifikasi ke dalam format JSON
            return response()->json($userNotifications);
        }

        // Jika pengguna tidak login, kembalikan response kosong
        return response()->json([]);
    }
}


