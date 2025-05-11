<?php

namespace App\Models;

use Database\Factories\ImunisasiModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StatusImunisasiModel extends Model
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
    public static function newFactory()
    {
        return ImunisasiModelFactory::new();
    }

}