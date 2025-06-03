<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = DokterModel::with('users')->get();

        return view('master-dokter.index', compact('dokter'));
    }

    public function create()
    {
        $users = UsersModel::where('role', 'Dokter')
                ->whereNotIn('id', function ($query) {
                    $query->select('users_id')->from('dokter');
                })
                ->get();        return view('master-dokter.create', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'no_str' => 'required|string|max:255',
            'spesialis' => 'nullable|string|max:255',
            'biografi' => 'nullable|string',
        ]);

        $sudahTerdaftar = DokterModel::where('users_id', $request->users_id)->exists();
        if ($sudahTerdaftar) {
            return redirect()->back()->withErrors(['users_id' => 'User ini sudah terdaftar sebagai dokter.'])->withInput();
        }

        DokterModel::create([
            'users_id' => $request->users_id,
            'no_str' => $request->no_str,
            'spesialis' => $request->spesialis,
            'biografi' => $request->biografi,
        ]);

        return redirect()->route('master-dokter')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = DokterModel::with('users')->findOrFail($id);
        // dd($dokter);
        return view('master-dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_str' => 'required|string|max:255',
            'spesialis' => 'nullable|string|max:255',
            'biografi' => 'nullable|string',
        ]);

        $dokter = DokterModel::findOrFail($id);

        $dokter->update([
            'no_str' => $request->no_str,
            'spesialis' => $request->spesialis,
            'biografi' => $request->biografi,
        ]);

        return redirect()->route('master-dokter')->with('success', 'Data dokter berhasil diupdate.');
    }
    public function detail($id)
    {
        $dokter = DokterModel::with('users')->findOrFail($id);
        return view('master-dokter.detail', compact('dokter'));
    }

    public function destroy($id)
    {
        $dokter = DokterModel::findOrFail($id);
        $dokter->delete();

        return redirect()->route('master-dokter')
                        ->with('success', 'Data dokter berhasil dihapus.');
    }


}
