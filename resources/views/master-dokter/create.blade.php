@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tambah Dokter </h3>
            <nav aria-label="breadcrumb"></nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST" action="{{ route('master-dokter.store') }}">
                                @csrf

                                <div class="row">
                                    <!-- Pilih User Dokter -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pilih User</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="users_id" required>
                                                    <option value="">-- Pilih Dokter --</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->email }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- No. STR -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">No. STR</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_str" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Spesialis -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Spesialis</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="spesialis" placeholder="Contoh: Anak, Kandungan (opsional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Biografi -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Biografi</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="biografi" rows="4" placeholder="Tuliskan biografi dokter (opsional)"></textarea>
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
@endsection
