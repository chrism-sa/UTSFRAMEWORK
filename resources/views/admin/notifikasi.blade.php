@extends('layouts.app')
<!--resources\views\admin\notifikasi.blade.php-->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Kelola Notifikasi') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Pesan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @php
                                        $user = App\Models\User::find($notification->user_id); // Mengambil data pengguna berdasarkan user_id
                                        @endphp
                                        @if($user)
                                        {{ $user->name }} <!-- Menampilkan nama pengguna -->
                                        @else
                                        Pengguna tidak ditemukan
                                        @endif
                                    </td>
                                    <td>{{ $notification->message }}</td>
                                    <td>{{ $notification->created_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.notification.delete', $notification->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
