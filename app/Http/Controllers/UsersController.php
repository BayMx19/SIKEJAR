<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = UsersModel::all();

        return view('/master-users.index', compact('users'));
    }

    public function create(){
        return view('/master-users.create');
    }

    public function store(Request $request)
    {

        try{
            DB::table('users')->insert([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama' => $request->nama,
                'NIK' => $request->NIK,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat,
                'RT' => $request->RT,
                'RW' => $request->RW,
                'role' => $request->role,
                'status' => $request->status,
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect('/master-users')->with('success', 'User berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect('/master-users')->with('error', 'Gagal menambahkan User: Coba Lagi' );
        }
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $user = UsersModel::findOrFail($id);
        return view('master-users.edit', compact('user'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {


        $user = UsersModel::find($id);
        DB::table('users')->where('id', $id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'nama' => $request->nama,
                'NIK' => $request->NIK,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat,
                'RT' => $request->RT,
                'RW' => $request->RW,
                'role' => $request->role,
                'status' => $request->status,
        ]);

        return redirect('master-users')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = UsersModel::findOrFail($id);
        $user->delete();

        return redirect('master-users')->with('success', 'Data berhasil dihapus!');
    }
}