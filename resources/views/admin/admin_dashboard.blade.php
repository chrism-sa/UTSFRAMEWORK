<!-- resources/views/layouts/app.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
            <div class="col-md-12 mb-3">
                    <h5 class="text-center">Welcome to Application {{ Auth::user()->name }}</h3>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-5x mb-5"></i>
                            <h5 class="card-title">Kelola Jadwal</h5>
                            <p class="card-text">Kelola jadwal kuliah</p>
                            <a href="{{ route('admin.kelolajadwal.index') }}" class="btn btn-primary btn-block">Kelola Jadwal</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-user fa-5x mb-5"></i>
                            <h5 class="card-title">Kelola Pengguna</h5>
                            <p class="card-text">Kelola informasi pengguna</p>
                            <a href="{{ route('admin.kelola.user') }}" class="btn btn-primary btn-block">Kelola Pengguna</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-bell fa-5x mb-5"></i>
                            <h5 class="card-title">Kelola Notifikasi</h5>
                            <p class="card-text">Kelola notifikasi jadwal</p>
                            <a href="{{ route('admin.notifikasi') }}" class="btn btn-primary btn-block">Kelola Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
