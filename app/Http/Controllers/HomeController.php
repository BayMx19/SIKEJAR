<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } else {
            $anak = collect(); // Ubah ke koleksi kosong agar tetap bisa diproses di view
        }

        return view('home', compact('anak'));
    }

    public function getImunisasi($anakId)
{
    $imunisasi = ImunisasiModel::where('anak_id', $anakId)
        ->orderBy('tanggal_imunisasi', 'desc') // Urutkan dari yang terbaru
        ->take(3) // Ambil hanya 3 data terbaru
        ->get();

    return response()->json($imunisasi);
}



    }
