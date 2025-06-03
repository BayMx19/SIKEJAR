<?php

namespace App\Http\Controllers;

use App\Events\JadwalImunisasiEvent;
use App\Models\AnakModel;
use App\Models\JadwalImunisasiModel;
use App\Models\User;
use App\Models\UsersModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Google\Client;
use Illuminate\Support\Facades\Log;


class JadwalImunisasiController extends Controller
{
    public function index()
    {
        $jadwal = JadwalImunisasiModel::with('anak')->get();

        return view('jadwal-imunisasi.index', compact('jadwal'));
    }

    public function create(){
        $anak = AnakModel::get();
        return view('jadwal-imunisasi.create', compact('anak'));
    }
    public function detail($id)
    {
        $jadwal = JadwalImunisasiModel::findOrFail($id);
        $listanak = AnakModel::all();

        return view('jadwal-imunisasi.detail', compact('jadwal', 'listanak'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'anak_id' => 'required|array',
            'anak_id.*' => 'exists:master_anak,id',
            'tanggal_imunisasi' => 'required|date',
            'jenis_imunisasi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        try{
            foreach ($request->anak_id as $anakId) {
            $jadwal = JadwalImunisasiModel::create([
                'anak_id' => $anakId,
                'tanggal_imunisasi' => $request->tanggal_imunisasi,
                'jenis_imunisasi' => $request->jenis_imunisasi,
                'keterangan' => $request->keterangan,
                'status' => "Belum",
            ]);
            $anak = AnakModel::find($anakId);

            if ($anak && $anak->users_id) {
                $user = UsersModel::find($anak->users_id);

                if ($user && $user->fcm_token) {
                    $this->sendFCMNotification($user->fcm_token, $jadwal);
                }
            }
            event(new JadwalImunisasiEvent($jadwal));
        }
            // Redirect kembali dengan pesan sukses
            return redirect('/jadwal-imunisasi')->with('success', 'Jadwal Imunisasi Anak berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect('/jadwal-imunisasi')->with('error', 'Gagal menambahkan Jadwal Imunisasi Anak: Coba Lagi' . $e->getMessage() );
        }


    }
    function getFCMToken()
    {
        $keyFilePath = storage_path('app/sikejar-posyandujambu-57a85bd5ac0b.json');

        if (!file_exists($keyFilePath)) {
            Log::error('Firebase Service Account JSON not found.');
            return null;
        }

        $client = new Client();
        $client->setAuthConfig($keyFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        try {
            $token = $client->fetchAccessTokenWithAssertion();
            return $token['access_token'] ?? null;
        } catch (\Exception $e) {
            Log::error('Error fetching FCM token: ' . $e->getMessage());
            return null;
        }
    }
    private function sendFCMNotification($fcmToken, $jadwal)
{
    Log::info("Mengirim FCM ke token: {$fcmToken}");
    $accessToken = $this->getFCMToken();

    if (!$accessToken) {
        \Log::error('Failed to get FCM Access Token');
        return;
    }

    $fcmUrl = 'https://fcm.googleapis.com/v1/projects/sikejar-posyandujambu/messages:send';

    $anak = DB::table('master_anak')->where('id', $jadwal->anak_id)->first();
    $namaAnak = $anak ? $anak->nama_anak : 'Anak';

    $postData = [
        "message" => [
            "token" => $fcmToken,
            "notification" => [
                "title" => "Jadwal Imunisasi Baru!",
                "body" => "Jadwal imunisasi untuk {$namaAnak} ({$jadwal->jenis_imunisasi}) telah ditetapkan pada {$jadwal->tanggal_imunisasi}. Harap datang tepat waktu!"
            ],
            "data" => [
                "nama_anak" => (string)$namaAnak,
                "jenis_imunisasi" => (string)$jadwal->jenis_imunisasi,
                "tanggal" => (string)$jadwal->tanggal_imunisasi,
            ],
            "android" => [
                "priority" => "high",
                "notification" => [
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ]
            ],
            "apns" => [
                "headers" => [
                    "apns-priority" => "10"
                ]
            ],
        ]
    ];

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->post($fcmUrl, $postData);

    if ($response->failed()) {
        Log::error('FCM Notification failed: ' . $response->body());
    } else {
        Log::info('FCM Notification sent successfully.');
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
    protected $jadwal;

    public function __construct(JadwalImunisasiModel $jadwal)
    {
        $this->jadwal = $jadwal;
    }
}
