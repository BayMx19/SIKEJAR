@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tambah Anak </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST" action="{{ route('master-anak.store') }}">
                                @csrf
                                <div class="row">
                                    <!-- Nama Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_anak" required
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NIK Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIK Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" minlength="16" maxlength="16"
                                                    name="NIK_anak" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Nama Orang Tua -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Orang Tua</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="users_id">
                                                    <option value="">Pilih Orang Tua</option>
                                                    @foreach($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Lahir Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Lahir Anak</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_lahir_anak"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Jenis Kelamin Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin Anak</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="jenis_kelamin">
                                                    <option value="">Pilih Jenis Kelamin</option>

                                                    <option value="L">
                                                        Laki - Laki</option>
                                                    <option value="P">
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="status">
                                                    <option value="">Pilih Status</option>

                                                    <option value="Sehat">
                                                        Sehat</option>
                                                    <option value="Sakit">
                                                        Sakit</option>
                                                    <option value="Wafat">
                                                        Wafat</option>
                                                </select>
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


<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Pilih Orang Tua",
        allowClear: true
    });
});
</script>

@endsection
