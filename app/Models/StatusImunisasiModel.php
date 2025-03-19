<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StatusImunisasiModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'imunisasi';
    protected $fillable = [
        'anak_id',
        'nama_anak',
        'NIK_anak',
        'tanggal_lahir_anak',
        'jenis_kelamin',
        'status',
        'jadwal_imunisasi'
    ];

    public function anak()
    {
        return $this->belongsTo(AnakModel::class, 'anak_id', 'id');
    }
    public function feedback()
    {
        return $this->hasOne(FeedbackModel::class, 'imunisasi_id');
    }

}