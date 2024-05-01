@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Jadwal</div>

                    <div class="card-body">
                        <form action="{{ route('admin.kelolajadwal.update', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ $jadwal->judul }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $jadwal->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ $jadwal->waktu_mulai }}" required>
                            </div>
                            <!-- Tambahkan input untuk atribut lainnya seperti waktu_selesai, lokasi, waktu_notifikasi -->
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.kelolajadwal.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
