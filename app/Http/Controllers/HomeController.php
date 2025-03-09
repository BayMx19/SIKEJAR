<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
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

    // Jika User (Orang Tua), ambil data anak berdasarkan users_id
    if ($user->role == 'User') {
        $anak = AnakModel::where('users_id', $user->id)
                         ->with('imunisasi') // Pastikan relasi dengan tabel imunisasi ada
                         ->get();
    } else {
        $anak = [];
    }

        return view('home', compact('anak'));
    }
}