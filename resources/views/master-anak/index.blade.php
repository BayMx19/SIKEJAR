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
            <h3 class="page-title"> Master Users </h3>
            <nav aria-label="breadcrumb">
            </nav>
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
                                    <th>Nama Orang Tua</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anak as $anak)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $anak->nama_anak}}</td>
                                    <td>{{ $anak->users->nama }}</td>
                                    <td>{{ $anak->tanggal_lahir_anak }}</td>
                                    <td>{{ $anak->jenis_kelamin }}</td>
                                    <td>{{ $anak->status }}</td>
                                    <td>
                                        <a href="{{ route('master-anak.edit', $anak->id) }}"
                                            class="btn btn-warning btn-sm me-2">Edit</a>

                                        <form action="{{ route('master-anak.destroy', $anak->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Floating Button -->
        <a href="{{ route('master-anak.create') }}" class="btn btn-primary floating-btn">
            <i class="mdi mdi-plus"></i> <!-- Ikon tambah -->
        </a>
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