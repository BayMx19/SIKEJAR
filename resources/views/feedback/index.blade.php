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
            <h3 class="page-title"> Feedback </h3>
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
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Komentar</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedback as $feedback)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{\Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $feedback->users->nama }}</td>
                                    <td>{{$feedback->komentar}}</td>
                                    <td>
                                        <a href="{{ route('feedback.detail', $feedback->id) }}"
                                            class="btn btn-primary btn-sm me-2">Detail</a>
                                        @if(Auth::user()->role == 'Kader' )

                                        <a href="{{ route('feedback.edit', $feedback->id) }}"
                                            class="btn btn-warning btn-sm me-2">Edit</a>

                                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST"
                                            style="display:inline;">
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
        @if(Auth::user()->role == 'SuperAdmin' )

        <!-- Floating Button -->
        <a href="{{ route('feedback.create') }}" class="btn btn-primary floating-btn">
            <i class="mdi mdi-plus"></i> <!-- Ikon tambah -->
        </a>
        @endif
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
