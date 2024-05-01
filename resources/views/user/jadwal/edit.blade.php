@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jadwal</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $jadwal->judul }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $jadwal->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ date('Y-m-d\TH:i', strtotime($jadwal->waktu_mulai)) }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai" value="{{ date('Y-m-d\TH:i', strtotime($jadwal->waktu_selesai)) }}">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $jadwal->lokasi }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_notifikasi">Pengingat disetel pada:</label>
                            <text class="form-control" id="waktu_notifikasi" name="waktu_notifikasi" readonly>{{ date('m/d/Y h:i A', strtotime($jadwal->waktu_notifikasi)) }}</text>
                        </div>
                        <div class="form-group">
                            <label for="waktu_notifikasi">Ubah Pengingat</label>
                            <select class="form-control" id="waktu_notifikasi" name="waktu_notifikasi">
                                <option value="" selected disabled>Pilih waktu pengingat</option>
                                @foreach([5, 10, 30] as $option)
                                <option value="{{ $option }}" {{ $jadwal->waktu_notifikasi == $option ? 'selected' : '' }}>
                                    {{ $option }} Menit Sebelum
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.jadwal.index') }}"class="btn btn-warning float-right">Kembali Ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection