@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Jadwal</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.kelolajadwal.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai">
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                        </div>
                        <div class="form-group">
                            <label for="waktu_notifikasi">Setel Pengingat</label>
                            <select class="form-control" id="waktu_notifikasi" name="waktu_notifikasi">
                                <option value="" selected disabled>Pilih Waktu Pengingat</option>
                                <option value="5">5 Menit Sebelum</option>
                                <option value="10">10 Menit Sebelum</option>
                                <option value="30">30 Menit Sebelum</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.kelolajadwal.index') }}" class="btn btn-secondary float-right">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection