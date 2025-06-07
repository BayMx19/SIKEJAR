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
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAllAnak">
                                                <label class="form-check-label" for="selectAllAnak">
                                                    Pilih Semua
                                                </label>
                                            </div>

                                            <div id="anakCheckboxList" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                                @foreach($anak as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input anak-checkbox" type="checkbox" name="anak_id[]" value="{{ $item->id }}" id="anak{{ $item->id }}">
                                                    <label class="form-check-label" for="anak{{ $item->id }}">
                                                        {{ $item->nama_anak }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>

                                            <small class="form-text text-muted">Pilih lebih dari satu anak</small>
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
<script>
 document.getElementById('selectAllAnak').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.anak-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

@endsection
