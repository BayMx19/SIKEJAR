@extends('layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title"> Dashboard </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Selamat Datang, {{ Auth::user()->nama }}!</h4>

                        @if(Auth::user()->role == 'User')
                        <p>Berikut adalah data anak Anda:</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status Imunisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anak as $item)
                                <tr>
                                    <td>{{ $item->nama_anak }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_lahir_anak)) }}</td>
                                    <td>{{ $item->imunisasi->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p>Selamat bertugas!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection