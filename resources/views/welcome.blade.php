@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div id="imageSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner text-center"> <!-- Tambahkan kelas text-center di sini -->
                        <div class="carousel-item active">
                            <img src="{{ asset('gambar/gambar1.jpg') }}" class="d-block rounded-lg mx-auto" style="max-width: 600px; height: auto;" alt="Gambar 1"> <!-- Tambahkan kelas mx-auto untuk meletakkan gambar di tengah -->
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('gambar/gambar2.jpg') }}" class="d-block rounded-lg mx-auto" style="max-width: 600px; height: auto;" alt="Gambar 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('gambar/gambar3.jpg') }}" class="d-block rounded-lg mx-auto" style="max-width: 600px; height: auto;" alt="Gambar 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('gambar/gambar4.jpg') }}" class="d-block rounded-lg mx-auto" style="max-width: 600px; height: auto;" alt="Gambar 4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Welcome to Sistem Manajemen Penjadwalan</h2>
                <p class="text-center" style="font-size: 18px; color: #333;">Selamat datang di aplikasi Manajemen Penjadwalan. Aplikasi ini membantu Anda mengatur jadwal dengan lebih efisien dan mudah. Kami menyediakan fitur-fitur yang dapat membantu Anda mengelola jadwal tugas, acara, dan lainnya. Silakan login atau register untuk mulai menggunakan aplikasi kami.</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Pastikan jQuery sudah dimuat sebelum script ini -->
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $('#imageSlider').carousel('next');
            }, 100);
        });
    </script>
@endpush
