<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import model User

class KelolaUserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna dari database
        return view('admin.kelolauser', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID

        // Kemudian kirim data pengguna ke view untuk diedit
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form edit pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string|max:255',
        ]);

        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        // Redirect kembali ke halaman kelola pengguna dengan pesan sukses
        return redirect()->route('admin.kelola.user')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        $user->delete(); // Hapus pengguna dari database

        // Redirect kembali ke halaman kelola pengguna dengan pesan sukses
        return redirect()->route('admin.kelola.user')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
