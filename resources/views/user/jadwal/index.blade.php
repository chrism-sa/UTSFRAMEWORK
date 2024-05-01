@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Jadwal</h3>
                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>
                </div>
                <div class="card-body">
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari jadwal...">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Lokasi</th>
                                    <th>Pengingat</th>
                                    <th>Action</th>
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
                                    <td>{{ $jadwal->waktu_notifikasi }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteJadwal('{{ $jadwal->id }}')">Hapus</button>
                                            <form id="delete-form-{{ $jadwal->id }}" action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-warning float-right">Kembali Ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteJadwal(id) {
        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            text: 'Anda akan menghapus jadwal ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Fungsi untuk melakukan pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByTagName("table")[0];
        tr = table.getElementsByTagName("tr");

        // Melakukan iterasi pada semua baris tabel, dan menyembunyikan yang tidak sesuai dengan kriteria pencarian
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Kolom kedua merupakan kolom judul
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
@endsection
