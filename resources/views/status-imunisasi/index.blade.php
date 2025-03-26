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
            <h3 class="page-title"> Status Imunisasi </h3>
            <nav aria-label="breadcrumb">
            </nav>
            <!-- Search Form -->
            <form action="{{ route('status-imunisasi') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama Anak..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary me-2">Cari</button>
                <a href="{{ route('status-imunisasi') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Imunisasi</th>
                                    <th>Jenis Imunisasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($status as $status)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $status->anak->nama_anak }}</td>
                                    <td>{{ $status->anak->tanggal_lahir_anak }}</td>
                                    <td>{{ $status->anak->users->nama }}</td>
                                    <td>{{ $status->anak->users->alamat }}</td>
                                    <td>{{ date('d-m-Y', strtotime($status->tanggal_imunisasi)) }}</td>
                                    <td>{{ $status->jenis_imunisasi }}</td>
                                    <td>
                                        @if($status->status == 'Tertinggal')
                                        <span class="text-danger fw-bold">{{ $status->status }}</span>
                                        @elseif($status->status == 'Sudah')
                                        <span class="text-success fw-bold">{{ $status->status }}</span>
                                        @else
                                        <span>{{ $status->status }}</span>
                                        @endif
                                    <td>
                                        <a href="{{ route('status-imunisasi.detail', $status->id) }}"
                                            class="btn btn-warning btn-sm me-2">Lihat</a>
                                        @if(Auth::user()->role == 'Kader' )

                                        <form action="{{ route('status-imunisasi.destroy', $status->id) }}"
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
