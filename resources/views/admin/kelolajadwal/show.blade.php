@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- Mengubah lebar kolom menjadi 8 -->
                <div class="card">
                    <div class="card-header">Detail Jadwal</div>

                    <div class="card-body">
                        <div class="row justify-content-center"> <!-- Mengubah posisi konten menjadi tengah -->
                            <div class="col-md-10"> <!-- Mengubah lebar kolom konten menjadi 10 -->
                                <h4>Judul: {{ $jadwal->judul }}</h4>
                                <p>Deskripsi: {{ $jadwal->deskripsi }}</p>
                                <p>Waktu Mulai: {{ $jadwal->waktu_mulai }}</p>
                                <p>Waktu Selesai: {{ $jadwal->waktu_selesai }}</p>
                                <p>Lokasi: {{ $jadwal->lokasi }}</p>
                                <p>Dibuat Oleh: {{ $jadwal->user->name }}</p>
                            </div>
                        </div>
                        <div class="mt-3"> <!-- Menambah margin atas untuk tombol -->
                            <a href="{{ route('admin.kelolajadwal.index') }}" class="btn btn-primary float-left">Kembali</a> <!-- Mengubah posisi tombol kembali menjadi kiri -->
                            <a href="{{ route('admin.kelolajadwal.edit', $jadwal->id) }}" class="btn btn-success float-left ml-2">Edit</a> <!-- Mengubah posisi tombol edit menjadi kiri dan menambahkan margin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
