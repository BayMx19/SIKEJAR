<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Jika User (Orang Tua), ambil data anak berdasarkan user_id
        if ($user->role == 'User') {
            $anak = AnakModel::where('users_id', $user->id)
                             ->with(['imunisasi' => function ($query) {
                                 $query->latest()->limit(3); // Ambil data imunisasi terbaru
                             }])
                             ->get();

            $riwayat = DB::table('feedback')
             ->join('imunisasi', 'feedback.imunisasi_id', '=', 'imunisasi.id')
            ->where('feedback.users_id', $user->id)
            ->get();

            // dd($riwayat);
        } else {
            $anak = collect();
            $riwayat = collect();
        }

        return view('home', compact('anak', 'riwayat'));
    }

        public function getImunisasi($anakId)
    {
        $userId = Auth::id();
        $imunisasi = ImunisasiModel::where('anak_id', $anakId)
            ->orderBy('tanggal_imunisasi', 'desc') // Urutkan dari yang terbaru
            ->take(3) // Ambil hanya 3 data terbaru
            ->get()
            ->map(function ($item) use ($userId) {
            $item->sudah_feedback = DB::table('feedback')
                ->where('imunisasi_id', $item->id)
                ->where('users_id', $userId)
                ->exists();
            return $item;
        });

        return response()->json($imunisasi);
    }
    public function detail($id)
    {
        $anak = AnakModel::findOrFail($id);
        $users = UsersModel::where('role', 'User')->get();

        return view('master-anak.detail', compact('anak', 'users'));
    }

    public function grafikBBTB()
{
    $userId = Auth::id();

    $anakList = AnakModel::where('users_id', $userId)->get();

    $dataBB = [];
    $dataTB = [];

    foreach ($anakList as $anak) {
        $catatan = DB::table('imunisasi')
            ->where('anak_id', $anak->id)
            ->orderBy('tanggal_imunisasi')
            ->get(['tanggal_imunisasi', 'berat_badan', 'tinggi_badan']);

        $dataBB['anak_'.$anak->id] = $catatan->map(function ($item) {
            return [
                'tanggal_imunisasi' => \Carbon\Carbon::parse($item->tanggal_imunisasi)->toDateString(),
                'berat_badan' => $item->berat_badan
            ];
        });

        $dataTB['anak_'.$anak->id] = $catatan->map(function ($item) {
            return [
                'tanggal_imunisasi' => \Carbon\Carbon::parse($item->tanggal_imunisasi)->toDateString(),
                'tinggi_badan' => $item->tinggi_badan
            ];
        });
    }

    return response()->json([
        'berat_badan' => $dataBB,
        'tinggi_badan' => $dataTB,
        'anak' => $anakList->mapWithKeys(fn($a) => ['anak_'.$a->id => $a->nama_anak]),
    ]);
}


    }
