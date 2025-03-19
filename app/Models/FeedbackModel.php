<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FeedbackModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'feedback';

    protected $fillable = [
        'users_id',
        'imunisasi_id',
        'komentar',
    ];

    public function users()
    {
        return $this->belongsTo(UsersModel::class, 'users_id', 'id');
    }
    public function jadwalImunisasi()
    {
        return $this->belongsTo(JadwalImunisasiModel::class, 'imunisasi_id');
    }
    public function statusImunisasi()
    {
        return $this->belongsTo(StatusImunisasiModel::class, 'imunisasi_id');
    }

}
