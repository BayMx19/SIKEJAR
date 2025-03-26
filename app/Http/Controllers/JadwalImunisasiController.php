<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
use App\Models\JadwalImunisasiModel;
use App\Models\UsersModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalImunisasiController extends Controller
{
    public function index()
    {
        $jadwal = JadwalImunisasiModel::with('anak')->get();

        return view('/jadwal-imunisasi.index', compact('jadwal'));
    }

    public function create(){
        $anak = AnakModel::get();
        return view('/jadwal-imunisasi.create', compact('anak'));
    }
    public function detail($id)
    {
        $jadwal = JadwalImunisasiModel::findOrFail($id);
        $listanak = AnakModel::all();

        return view('jadwal-imunisasi.detail', compact('jadwal', 'listanak'));
    }

    public function store(Request $request)
    {
        try{
            DB::table('imunisasi')->insert([
                'anak_id' => $request->anak_id,
                'tanggal_imunisasi' => $request->tanggal_imunisasi,
                'jenis_imunisasi' => $request->jenis_imunisasi,
                'keterangan' => $request->keterangan,
                'status' => "Belum",
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect('/jadwal-imunisasi')->with('success', 'Jadwal Imunisasi Anak berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect('/jadwal-imunisasi')->with('error', 'Gagal menambahkan Jadwal Imunisasi Anak: Coba Lagi' );
        }


    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jadwal = JadwalImunisasiModel::findOrFail($id);
        $listanak = AnakModel::all();

        return view('jadwal-imunisasi.edit', compact('jadwal', 'listanak'));
    }
    // Mengupdate data
    public function update(Request $request, $id)
    {
        $jadwal = JadwalImunisasiModel::find($id);

        DB::table('imunisasi')->where('id', $id)->update([
            'tanggal_imunisasi' => $request->tanggal_imunisasi,
            'jenis_imunisasi' => $request->jenis_imunisasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('jadwal-imunisasi')->with('success', 'Jadwal Imunisasi Anak berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $jadwal = JadwalImunisasiModel::findOrFail($id);
        $jadwal->delete();

        return redirect('jadwal-imunisasi')->with('success', 'Jadwal Imunisasi Anak berhasil dihapus!');
    }
}
