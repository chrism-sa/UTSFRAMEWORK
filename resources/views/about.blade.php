@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('About Me') }}</div>

                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('profile.jpg') }}" alt="Profile Photo" class="img-fluid rounded-circle border border-dark" style="width: 150px; height: 150px;">
                        </div>
                        <p>NIM  : 210605110083</p>
                        <p>Nama : Charis Maulana S. A</p>
                        <p>Framework Programming 2024</p>
                        
                        <!-- Tombol untuk kembali ke halaman welcome -->
                        <a href="{{ route('home') }}" class="btn btn-primary mr-2">Dashboard</a>
                        
                        <!-- Tombol untuk menuju halaman login/register -->
                        <a href="{{ route('login') }}" class="btn btn-warning mr-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary mr-2">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
