@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h5 class="text-center">Welcome to Application {{ Auth::user()->name }}</h3>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                            <h5 class="card-title">Lihat & Buat Jadwal</h5>
                            <p class="card-text">Manage jadwal Anda</p>
                            <a href="{{ route('user.jadwal.index') }}" class="btn btn-primary btn-block">Lihat Jadwal</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-user fa-3x mb-3"></i>
                            <h5 class="card-title">Profil</h5>
                            <p class="card-text">Lihat dan ubah profil Anda</p>
                            <a href="{{ route('user.profil') }}" class="btn btn-primary btn-block">Profil Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
