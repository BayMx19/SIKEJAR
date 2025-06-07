<h2>Halo Bunda,</h2>
<p>Berikut ini jadwal imunisasi terbaru untuk anak Anda:</p>

<ul>
    <li><strong>Nama Anak:</strong> {{ $namaAnak }}</li>
    <li><strong>Jenis Imunisasi:</strong> {{ $jadwal->jenis_imunisasi }}</li>
    <li><strong>Tanggal Imunisasi:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal_imunisasi)->format('d-m-Y') }}</li>
</ul>

<p>Harap hadir tepat waktu sesuai jadwal. Terima kasih!</p>
