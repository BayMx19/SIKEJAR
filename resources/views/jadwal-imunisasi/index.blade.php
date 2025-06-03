@extends('layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Flash Message -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="page-header">
            <h3 class="page-title"> Jadwal Imunisasi </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if(Auth::user()->role == 'Kader')
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('jadwal-imunisasi.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus"></i> Tambah Jadwal Imunisasi
                            </a>
                        </div>
                        @endif
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NIK Orang Tua</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Tanggal Imunisasi</th>
                                    <th>Jenis Imunisasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $jadwal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jadwal->anak->nama_anak }}</td>
                                    <td>{{ $jadwal->anak->tanggal_lahir_anak }}</td>
                                    <td>{{  $jadwal->anak->users->NIK}}</td>
                                    <td>{{ $jadwal->anak->users->nama }}</td>
                                    <td>{{ date('d-m-Y', strtotime($jadwal->tanggal_imunisasi)) }}</td>
                                    <td>{{ $jadwal->jenis_imunisasi }}</td>
                                    <td>{{ $jadwal->status }}</td>
                                    <td>
                                        <a href="{{ route('jadwal-imunisasi.detail', $jadwal->id) }}"
                                            class="btn btn-primary btn-sm me-2">Detail</a>
                                        @if(auth()->user()->role === 'Kader')
                                        <a href="{{ route('jadwal-imunisasi.edit', $jadwal->id) }}"
                                            class="btn btn-warning btn-sm me-2">Edit</a>

                                        <form action="{{ route('jadwal-imunisasi.destroy', $jadwal->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?');">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
setTimeout(function() {
    let alertElements = document.querySelectorAll('.alert');
    alertElements.forEach(function(alert) {
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>

@endsection
