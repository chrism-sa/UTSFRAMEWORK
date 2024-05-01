@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Kelola Jadwal</div>

                    <div class="card-body">
                        <a href="{{ route('admin.kelolajadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>
                        <form action="{{ route('admin.kelolajadwal.index') }}" method="GET" class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Cari jadwal" aria-label="Search" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Waktu Mulai</th>
                                    <th scope="col">Waktu Selesai</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Dibuat Oleh</th>
                                    <th scope="col">Aksi</th> <!-- Kolom untuk aksi: tampilkan detail dan hapus -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwals as $key => $jadwal)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $jadwal->judul }}</td>
                                        <td>{{ $jadwal->deskripsi }}</td>
                                        <td>{{ $jadwal->waktu_mulai }}</td>
                                        <td>{{ $jadwal->waktu_selesai }}</td>
                                        <td>{{ $jadwal->lokasi }}</td>
                                        <td>{{ $jadwal->user->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.kelolajadwal.show', $jadwal->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <form action="{{ route('admin.kelolajadwal.delete', $jadwal->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
