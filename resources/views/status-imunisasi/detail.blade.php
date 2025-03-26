@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Status Imunisasi Anak </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST"
                                action="{{ route('status-imunisasi.update', $status->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"><b>Data Anak</b></label>

                                </div>
                                <div class="row">

                                    <!-- Nama Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->nama_anak }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- NIK Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIK Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->NIK_anak }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- Tanggal Lahir Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Lahir Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->tanggal_lahir_anak }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Jenis Kelamin Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin Anak</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"><b>Data Orang Tua Anak</b></label>
                                </div>
                                <div class="row">
                                    <!-- Nama Orang Tua -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Orang Tua</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->nama }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Alamat -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->alamat }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- RT -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">RT</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->RT }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RW -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">RW</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->RW }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- NIK -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->NIK }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nomor Telepon  -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nomor Telepon </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    value="{{ $status->anak->users->nomor_telepon }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"><b>Data Imunisasi</b></label>
                                </div>
                                <div class="row">
                                    <!-- Jenis Imunisasi -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Imunisasi</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="jenis_imunisasi"
                                                    autocomplete="off" value="{{$status->jenis_imunisasi}}" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tanggal Imunisasi -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Imunisasi</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_imunisasi"
                                                    required autocomplete="off" value="{{$status->tanggal_imunisasi}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status Imunisasi</label>
                                            <div class="col-sm-9">
                                                @if(Auth::user()->role == 'Kader')
                                                <select class="form-select" name="status">
                                                    <option value="Belum"
                                                        {{ (old('status', $status->status ?? '') == 'Belum') ? 'selected' : '' }}>
                                                        Belum</option>
                                                    <option value="Sudah"
                                                        {{ (old('status', $status->status ?? '') == 'Sudah') ? 'selected' : '' }}>
                                                        Sudah</option>
                                                    <option value="Tertinggal"
                                                        {{ (old('status', $status->status ?? '') == 'Tertinggal') ? 'selected' : '' }}>
                                                        Tertinggal</option>
                                                </select>
                                                @else
                                                <input type="text" class="form-control" value="{{ $status->status }}"
                                                    readonly>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Keterangan -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="keterangan"
                                                    autocomplete="off" value="{{$status->keterangan}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>






                                @if(Auth::user()->role == 'Kader' )
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary">Ubah Status Imunisasi</button>
                                </div>
                                @endif
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
