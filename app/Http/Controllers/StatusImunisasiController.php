<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
use App\Models\DokterModel;
use App\Models\StatusImunisasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = StatusImunisasiModel::with('anak.users');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('anak', function ($q) use ($search) {
                $q->where('nama_anak', 'LIKE', "%$search%");
            });
        }

        $status = $query->get();
        return view('/status-imunisasi.index', compact('status'));
    }

    // Menampilkan form detail
    public function detail($id)
    {
        $status = StatusImunisasiModel::findOrFail($id);
        $listanak = AnakModel::all();
        $dokters = DokterModel::with('users')->get();

        return view('status-imunisasi.detail', compact('status', 'listanak', 'dokters'));
    }
    // Mengupdate data
    public function update(Request $request, $id)
    {
        // dd($request);
        $status = StatusImunisasiModel::find($id);

        DB::table('imunisasi')->where('id', $id)->update([
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'dokter_id' => $request->dokter_id
        ]);

        return redirect('status-imunisasi')->with('success', 'Status Imunisasi Anak berhasil diperbarui!');
    }
    // Menghapus data pengguna
    public function destroy($id)
    {
        $status = StatusImunisasiModel::findOrFail($id);
        $status->delete();

        return redirect('status-imunisasi')->with('success', 'Status Imunisasi Anak berhasil dihapus!');
    }
}
