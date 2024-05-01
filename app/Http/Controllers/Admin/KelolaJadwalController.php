<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth; 

class KelolaJadwalController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $search = $request->query('search'); // Ambil kata kunci pencarian dari URL
    
        // Query untuk mendapatkan jadwal dengan filter pencarian jika ada
        $jadwals = Jadwal::with('user')
                        ->when($search, function ($query) use ($search) {
                            $query->where('judul', 'like', '%' . $search . '%')
                                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                                  ->orWhere('lokasi', 'like', '%' . $search . '%');
                        })
                        ->get();
    
        return view('admin.kelolajadwal.index', compact('jadwals'));
    }
    


    public function create()
    {
        return view('admin.kelolajadwal.create');
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
    
        return redirect()->route('admin.kelolajadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }
    

    public function show($id)
    {
        $jadwal = Jadwal::with('user')->findOrFail($id); // Ambil jadwal dengan informasi pengguna yang membuatnya
        return view('admin.kelolajadwal.show', compact('jadwal'));
    }

    public function edit($id)
{
    $jadwal = Jadwal::findOrFail($id);
    return view('admin.kelolajadwal.edit', compact('jadwal'));
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

    // Hitung waktu notifikasi berdasarkan waktu mulai
    $waktuMulai = new \DateTime($request->waktu_mulai); // Perhatikan penggunaan \DateTime
    $interval = new \DateInterval('PT' . $request->waktu_notifikasi . 'M'); // Perhatikan penggunaan \DateInterval
    $jadwal->waktu_notifikasi = $waktuMulai->sub($interval)->format('Y-m-d H:i:s');

    $jadwal->save();

    return redirect()->route('admin.kelolajadwal.index')->with('success', 'Jadwal berhasil diperbarui');
}
public function destroy($id)
{
    // Menghapus notifikasi terkait dengan jadwal yang dihapus
    $jadwal = Jadwal::findOrFail($id);
    $jadwal->notifications()->delete(); // Menghapus semua notifikasi terkait dengan jadwal
    
    // Menghapus jadwal itu sendiri
    $jadwal->delete();

    return redirect()->route('admin.kelolajadwal.index')->with('success', 'Jadwal berhasil dihapus');
}

}

