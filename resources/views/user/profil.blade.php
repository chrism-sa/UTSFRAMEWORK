@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 30px;"> <!-- Tambahkan padding atas 20px -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Info Akun') }}</div>

                    <div class="card-body">
                        <div class="text-center mb-3"> <!-- Mengubah alignment menjadi center -->
                            <h4>Hi, {{ Auth::user()->name }}</h4>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Anda sebagai: {{ Auth::user()->role }}</p>
                        </div>
                    </div>

                    <!-- Tombol Kembali di bagian kiri bawah -->
                    <div class="card-footer text-left">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-warning float-right">Kembali Ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
