import "./bootstrap";
window.Echo.channel("jadwal-imunisasi").listen(
    ".jadwal-imunisasi-event",
    (data) => {
        alert(
            `Jadwal imunisasi baru telah ditetapkan untuk ${data.anak.nama_anak}`
        );
    }
);
