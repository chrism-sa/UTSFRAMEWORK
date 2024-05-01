<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
{
    // Ambil ID pengguna yang sedang login
    $userId = Auth::id();

    // Ambil jadwal berdasarkan user ID yang sedang login
    $jadwals = Jadwal::where('user_id', $userId)->get();

    return view('user.jadwal.index', compact('jadwals'));
}


    public function create()
    {
        return view('user.jadwal.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        'lokasi' => 'required',
        'waktu_notifikasi' => 'required|integer', // Validasi waktu_notifikasi
    ]);

    // Ambil nilai waktu_notifikasi dari form
    $waktuNotifikasi = $request->waktu_notifikasi;

    // Ambil waktu mulai dari form
    $waktuMulai = Carbon::parse($request->waktu_mulai);

    // Hitung waktu notifikasi berdasarkan pilihan combo box
    $waktuNotifikasiCarbon = $waktuMulai->subMinutes($waktuNotifikasi);

    // Buat objek Jadwal dan isi dengan data dari request
    $jadwal = new Jadwal();
    $jadwal->judul = $request->judul;
    $jadwal->deskripsi = $request->deskripsi;
    $jadwal->waktu_mulai = $request->waktu_mulai;
    $jadwal->waktu_selesai = $request->waktu_selesai;
    $jadwal->lokasi = $request->lokasi;
    $jadwal->waktu_notifikasi = $waktuNotifikasiCarbon;

    // Cek apakah user sedang login dan atur user_id
    if (Auth::check()) {
        $jadwal->user_id = Auth::id();
    }

    // Simpan objek Jadwal ke database
    $jadwal->save();

    // Simpan notifikasi ke database
    $notification = new Notification();
    $notification->user_id = Auth::id();
    $notification->message = 'Anda memiliki jadwal baru: ' . $request->judul;
    $notification->save();

    return redirect()->route('user.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
}



    public function edit($id)
{
    $jadwal = Jadwal::findOrFail($id);
    return view('user.jadwal.edit', compact('jadwal'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        'lokasi' => 'required',
        'waktu_notifikasi' => 'required|numeric', // Validasi untuk waktu notifikasi
    ]);

    $jadwal = Jadwal::findOrFail($id);
    $jadwal->judul = $request->judul;
    $jadwal->deskripsi = $request->deskripsi;
    $jadwal->waktu_mulai = $request->waktu_mulai;
    $jadwal->waktu_selesai = $request->waktu_selesai;
    $jadwal->lokasi = $request->lokasi;

    // Konversi waktu notifikasi dari menit ke format yang sesuai sebelum menyimpannya
    $waktuMulai = new \DateTime($request->waktu_mulai);
    $interval = new \DateInterval('PT' . $request->waktu_notifikasi . 'M');
    $jadwal->waktu_notifikasi = $waktuMulai->sub($interval)->format('Y-m-d H:i:s');

    $jadwal->save();

    return redirect()->route('user.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
}


    public function destroy($id)
{
    $jadwal = Jadwal::findOrFail($id);

    // Hapus notifikasi terkait sebelum menghapus jadwal
    Notification::where('user_id', Auth::id())
                ->where('message', 'Anda memiliki jadwal baru: ' . $jadwal->judul)
                ->delete();

    $jadwal->delete();

    return redirect()->route('user.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
}
    
}
