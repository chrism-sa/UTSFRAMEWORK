<?php
// routes\web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KelolaJadwalController;
use App\Http\Controllers\Admin\KelolaUserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NotificationController;
// Rute Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rute Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rute Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Rute About Me
Route::get('/about', [AboutUsController::class, 'index'])->name('about');

// Rute Dashboard Admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
//Rute Dashboard User
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware('auth');

// Rute untuk kelola user
Route::get('/admin/kelola-user', [KelolaUserController::class, 'index'])->name('admin.kelola.user');
Route::get('/admin/kelola-user/edit/{id}', [KelolaUserController::class, 'edit'])->name('admin.user.edit'); // Rute untuk edit pengguna
Route::put('/admin/kelola-user/update/{id}', [KelolaUserController::class, 'update'])->name('admin.kelola.user.update'); // Rute untuk update pengguna
Route::delete('/admin/kelola-user/delete/{id}', [KelolaUserController::class, 'delete'])->name('admin.user.delete'); // Rute untuk hapus pengguna

// Rute untuk menampilkan view index tambah jadwal
Route::get('user/jadwal', [JadwalController::class, 'index'])->name('user.jadwal.index')->middleware('auth');

// Rute untuk menampilkan form tambah jadwal
Route::get('user/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create')->middleware('auth');

// Rute untuk menyimpan data jadwal baru
Route::post('user/jadwal', [JadwalController::class, 'store'])->name('user.jadwal.store')->middleware('auth');

// Rute untuk menampilkan form edit jadwal
Route::get('user/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit')->middleware('auth');

// Rute untuk menyimpan perubahan pada jadwal yang diedit
Route::put('user/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update')->middleware('auth');

// Rute untuk menghapus jadwal
Route::delete('user/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy')->middleware('auth');

// Rute untuk mengambil notifikasi pengguna
Route::get('/user/notifications', [NotificationController::class, 'getUserNotifications'])->name('user.notifications')->middleware('auth');

Route::get('/admin/notifikasi', [NotificationController::class, 'index'])->name('admin.notifikasi');

Route::delete('/admin/notification/{id}', [NotificationController::class, 'delete'])->name('admin.notification.delete');

Route::get('user/profil', [ProfilController::class, 'index'])->name('user.profil')->middleware('auth');

Route::group(['middleware' => ['auth', 'admin']], function () {
    // Rute untuk menampilkan halaman Kelola Jadwal
    Route::get('/admin/kelola/jadwal', [KelolaJadwalController::class, 'index'])->name('admin.kelolajadwal.index');

    Route::get('/admin/kelolajadwal/create', [KelolaJadwalController::class, 'create'])->name('admin.kelolajadwal.create');

    // Rute untuk menyimpan jadwal baru
    Route::post('/admin/kelolajadwal/store', [KelolaJadwalController::class, 'store'])->name('admin.kelolajadwal.store');

    // Rute untuk menampilkan detail jadwal
    Route::get('/admin/kelolajadwal/{id}', [KelolaJadwalController::class, 'show'])->name('admin.kelolajadwal.show');

    // Rute untuk menampilkan form edit jadwal
    Route::get('/admin/kelolajadwal/{id}/edit', [KelolaJadwalController::class, 'edit'])->name('admin.kelolajadwal.edit');

    // Rute untuk menyimpan perubahan pada jadwal
    Route::put('/admin/kelolajadwal/{id}/update', [KelolaJadwalController::class, 'update'])->name('admin.kelolajadwal.update');

    // Rute untuk menghapus jadwal
    Route::delete('/admin/kelolajadwal/{id}/delete', [KelolaJadwalController::class, 'destroy'])->name('admin.kelolajadwal.delete');

});
// Rute Home
Route::get('/', function () {
    return view('welcome');
})->name('home');
