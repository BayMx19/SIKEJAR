@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Detail Dokter </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample">
                            <div class="row">
                                <!-- Pilih User Dokter -->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">User</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $dokter->users->nama }} ({{ $dokter->users->email }})" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- No STR -->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No STR</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $dokter->no_str }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Spesialis -->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Spesialis</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $dokter->spesialis }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Biografi -->
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Biografi</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" readonly>{{ $dokter->biografi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
