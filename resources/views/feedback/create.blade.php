@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tambah Feedback </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST" action="{{ route('feedback.store') }}">
                                @csrf
                                <div class="row">
                                    <!-- Nama -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="users_id">
                                                    <option value="">Pilih Nama Orang Tua</option>
                                                    @foreach($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tanggal" required
                                                    autocomplete="off" value="{{ now()->format('d-m-Y') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Komentar -->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Komentar</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="komentar"
                                                    autocomplete="off" style="height: 100px;">
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>




@endsection