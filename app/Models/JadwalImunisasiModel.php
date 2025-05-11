<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JadwalImunisasiModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'imunisasi';
    protected $fillable = [
        'anak_id',
        'tanggal_imunisasi',
        'jenis_imunisasi',
        'keterangan',
        'status',
    ];

    public function anak()
    {
        return $this->belongsTo(AnakModel::class, 'anak_id', 'id');
    }

    public function feedback()
    {
        return $this->hasOne(FeedbackModel::class, 'imunisasi_id');
    }
    protected $jadwal;



    public function index()
    {
        $data = $this->jadwal->all();
        return view('jadwal-imunisasi.index', compact('data'));
    }

}
