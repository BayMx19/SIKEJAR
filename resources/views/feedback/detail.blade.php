@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Detail Feedback </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST"
                                action="{{ route('feedback.update', $feedback->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Nama -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="komentar"
                                                    autocomplete="off" value="{{$feedback->users->nama}}" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Tanggal -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tanggal" required
                                                    autocomplete="off"
                                                    value="{{ \Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y') }}"
                                                    readonly>
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
                                                    autocomplete="off" style="height: 100px;"
                                                    value="{{$feedback->komentar}}" readonly>
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
</div>
</div>




@endsection
