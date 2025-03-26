@extends('layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title"> Dashboard </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Selamat Datang, {{ Auth::user()->nama }}!</h4>
                        @if(Auth::user()->role == 'User')
                        <p>Berikut adalah data anak Anda:</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Detail Imunisasi</th>
                                    <th>Data Anak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anak as $item)
                                <tr>
                                    <td>{{ $item->nama_anak }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_lahir_anak)) }}</td>
                                    <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#imunisasiModal" onclick="loadImunisasi({{ $item->id }})">
                                            Detail Imunisasi
                                        </button></td>
                                    <td><a href="{{ route('master-anak.detail', $item->id) }}"
                                            class="btn btn-primary btn-sm me-2">Detail Anak</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p>Selamat bertugas!</p>
                        @endif
                    </div>

                    <!-- Modal Detail Imunisasi -->
                    <div class="modal fade" id="imunisasiModal" tabindex="-1" aria-labelledby="modalTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle">Detail Imunisasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Imunisasi</th>
                                                <th>Jenis Imunisasi</th>
                                                <th>Status</th>
                                                <th>Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody id="imunisasiData">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <!-- Form Feedback -->
                                    <form id="feedbackForm" action="{{ route('feedback.storedashboard') }}"
                                        method="POST" style="width: 100%; display: none;">
                                        @csrf
                                        <input type="hidden" name="imunisasi_id" id="feedbackImunisasiId">
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">

                                        <div class="input-group">
                                            <input type="text" name="komentar" class="form-control"
                                                placeholder="Masukkan feedback..." required>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
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
</div>
<script>
function showFeedbackForm(imunisasiId) {
    document.getElementById("feedbackImunisasiId").value = imunisasiId;
    document.getElementById("feedbackForm").style.display = "block";
}

function loadImunisasi(anakId) {
    // Kosongkan tabel sebelum mengisi data baru
    document.getElementById("imunisasiData").innerHTML = "<tr><td colspan='5'>Loading...</td></tr>";

    // Panggil endpoint untuk mendapatkan data imunisasi berdasarkan anak_id
    fetch(`/get-imunisasi/${anakId}`)
        .then(response => response.json())
        .then(data => {
            let rows = "";
            if (data.length > 0) {
                data.forEach(imunisasi => {
                    rows += `
                        <tr>
                            <td>${imunisasi.tanggal_imunisasi}</td>
                            <td>${imunisasi.jenis_imunisasi}</td>
                            <td>
                                <span class="badge ${imunisasi.status === 'Sudah' ? 'bg-success' : imunisasi.status === 'Tertinggal' ? 'bg-danger' : 'bg-secondary'}">
                                    ${imunisasi.status}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success" onclick="showFeedbackForm(${imunisasi.id})">
                                    Isi Feedback
                                </button>
                                <a href="/status-imunisasi/${imunisasi.id}/detail" class="btn btn-sm btn-info">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    `;
                });
            } else {
                rows = "<tr><td colspan='5' class='text-center'>Tidak ada data imunisasi</td></tr>";
            }
            document.getElementById("imunisasiData").innerHTML = rows;
        })
        .catch(error => {
            console.error("Error fetching data:", error);
            document.getElementById("imunisasiData").innerHTML =
                "<tr><td colspan='5' class='text-danger'>Gagal mengambil data.</td></tr>";
        });
}
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
// Pastikan koneksi ke Pusher
Pusher.logToConsole = true;

var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
    encrypted: true
});

var channel = pusher.subscribe('imunisasi-channel');
channel.bind('jadwal-imunisasi', function(data) {
    // console.log("📢 Notifikasi diterima:", data);
    alert("🔔 Jadwal imunisasi baru untuk anak anda telah ditambahkan!");
});
</script>

@endsection