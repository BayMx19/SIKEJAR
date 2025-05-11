<?php

namespace App\Http\Controllers;

use App\Models\FeedbackModel;
use App\Models\UsersModel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = FeedbackModel::with('users')->get();

        return view('feedback.index', compact('feedback'));
    }
    public function create(){
        $users = UsersModel::where('role', 'User')->get();
        return view('feedback.create', compact('users'));
    }

    public function store(Request $request)
    {
        try{

            DB::table('feedback')->insert([
                'users_id' => $request->users_id,
                'komentar' => $request->komentar,
                'created_at' => now(),
            ]);



            return redirect('/feedback')->with('success', 'Feedback berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect('/feedback')->with('error', 'Gagal menambahkan Feedback: Coba Lagi' . $e->getMessage());
        }


    }
    public function edit($id)
    {
        $users = UsersModel::where('role', 'User')->get();
        $feedback = FeedbackModel::findOrFail($id);
        return view('feedback.edit', compact('users','feedback'));
    }

    public function update(Request $request, $id)
    {


        $feedback = FeedbackModel::find($id);
        DB::table('feedback')->where('id', $id)->update([
            'users_id' => $request->users_id,
            'komentar' => $request->komentar,
            'updated_at' => now(),
    ]);

        return redirect('feedback')->with('success', 'Data berhasil diperbarui!');
    }

    public function detail($id)
    {
        $users = UsersModel::where('role', 'User')->get();
        $feedback = FeedbackModel::findOrFail($id);
        return view('feedback.detail', compact('users','feedback'));
    }

    public function destroy($id)
    {
        $feedback = FeedbackModel::findOrFail($id);
        $feedback->delete();

        return redirect('feedback')->with('success', 'Data berhasil dihapus!');
    }

    public function storeDashboard(Request $request)
{



    DB::table('feedback')->insert([
        'users_id' => Auth::id(),
        'imunisasi_id' => $request->imunisasi_id,
        'komentar' => $request->komentar,
        'created_at' => now(),
    ]);

    return back()->with('success', 'Feedback berhasil dikirim!');
}
}
