<?php

namespace App\Http\Controllers;

use App\Models\AnakModel;
use App\Models\UsersModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnakController extends Controller
{
    public function index()
    {
        $anak = AnakModel::with('users')->get();

        return view('/master-anak.index', compact('anak'));
    }
    public function create(){
        $users = UsersModel::where('role', 'User')->get();
        $anak = AnakModel::with('users')->get();
        return view('/master-anak.create', compact('users', 'anak'));
    }

    public function store(Request $request)
    {
        try{
            DB::table('master_anak')->insert([
                'users_id' => $request->users_id,
                'nama_anak' => $request->nama_anak,
                'NIK_anak' => $request->NIK_anak,
                'tanggal_lahir_anak' => $request->tanggal_lahir_anak,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status' => $request->status,
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect('/master-anak')->with('success', 'Anak berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect('/master-anak')->with('error', 'Gagal menambahkan Anak: Coba Lagi' );
        }


    }

    // Menampilkan form edit
    public function edit($id)
    {
        $anak = AnakModel::findOrFail($id);
        $users = UsersModel::where('role', 'User')->get();

        return view('master-anak.edit', compact('anak', 'users'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {


        $anak = AnakModel::find($id);
        DB::table('master_anak')->where('id', $id)->update([
                'users_id' => $request->users_id,
                'nama_anak' => $request->nama_anak,
                'NIK_anak' => $request->NIK_anak,
                'tanggal_lahir_anak' => $request->tanggal_lahir_anak,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status' => $request->status,
        ]);

        return redirect('master-anak')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $anak = AnakModel::findOrFail($id);
        $anak->delete();

        return redirect('master-anak')->with('success', 'Data berhasil dihapus!');
    }
}