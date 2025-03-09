@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tambah Jadwal Imunisasi Anak </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-sample" method="POST" action="{{ route('jadwal-imunisasi.store') }}">
                                @csrf
                                <div class="row">
                                    <!-- Nama Anak -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Anak</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="anak_id">
                                                    <option value="">Pilih Anak</option>
                                                    @foreach($anak as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_anak }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Imunisasi -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Imunisasi</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_imunisasi"
                                                    required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Jenis Imunisasi -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Imunisasi</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="jenis_imunisasi">
                                                    <option value="">Pilih Jenis Imunisasi</option>

                                                    <option value="BCG-Polio 1">
                                                        BCG-Polio 1
                                                    </option>
                                                    <option value="DPT-HB-Hib 1, Polio 2">
                                                        DPT-HB-Hib 1, Polio 2
                                                    </option>
                                                    <option value="DPT-HB-Hib 2, Polio 3">
                                                        DPT-HB-Hib 2, Polio 3
                                                    </option>
                                                    <option value="DPT-HB-Hib 3, Polio 4, IPV">
                                                        DPT-HB-Hib 3, Polio 4, IPV
                                                    </option>
                                                    <option value="Campak / Measles Rubella (MR)">
                                                        Campak / Measles Rubella (MR)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="keterangan"
                                                    autocomplete="off">
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
