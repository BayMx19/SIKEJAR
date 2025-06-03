@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Dokter </h3>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST" action="{{ route('master-dokter.update', $dokter->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Select User Dokter (readonly) -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Dokter</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="users_id" disabled>
                                            <option value="{{ $dokter->users->id }}">{{ $dokter->users->nama }} - {{ $dokter->users->email }}</option>
                                        </select>
                                        <input type="hidden" name="users_id" value="{{ $dokter->users->id }}">
                                    </div>
                                </div>

                                <!-- No STR -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No STR</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="no_str" class="form-control" value="{{ old('no_str', $dokter->no_str) }}" required>
                                    </div>
                                </div>

                                <!-- Spesialis -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Spesialis</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="spesialis" class="form-control" value="{{ old('spesialis', $dokter->spesialis) }}">
                                    </div>
                                </div>

                                <!-- Biografi -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Biografi</label>
                                    <div class="col-sm-9">
                                        <textarea name="biografi" class="form-control" rows="4">{{ old('biografi', $dokter->biografi) }}</textarea>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
