@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Users </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST"
                                action="{{ route('master-users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" required
                                                    autocomplete="off" value="{{$user->username}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" required
                                                    autocomplete="off" value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Nama -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama" autocomplete="off"
                                                    value="{{$user->nama}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NIK -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="NIK" maxlength="16"
                                                    autocomplete="off" value="{{$user->NIK}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <!-- Role -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="role" required>
                                                    <option value="User"
                                                        {{ (old('role', $user->role ?? '') == 'User') ? 'selected' : '' }}>
                                                        User</option>
                                                    <option value="Kader"
                                                        {{ (old('role', $user->role ?? '') == 'Kader') ? 'selected' : '' }}>
                                                        Kader</option>
                                                    <option value="SuperAdmin"
                                                        {{ (old('role', $user->role ?? '') == 'SuperAdmin') ? 'selected' : '' }}>
                                                        SuperAdmin</option>
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
                                                    <option value="ACTIVE"
                                                        {{ (old('status', $user->status ?? '') == 'ACTIVE') ? 'selected' : '' }}>
                                                        ACTIVE</option>
                                                    <option value="INACTIVE"
                                                        {{ (old('status', $user->status ?? '') == 'INACTIVE') ? 'selected' : '' }}>
                                                        INACTIVE</option>
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


@endsection
