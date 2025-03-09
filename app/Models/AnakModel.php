<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AnakModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'master_anak';
    protected $fillable = [
        'users_id',
        'nama_anak',
        'NIK_anak',
        'tanggal_lahir_anak',
        'jenis_kelamin',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(UsersModel::class, 'users_id', 'id');
    }

    public function jadwalImunisasi()
    {
        return $this->hasMany(JadwalImunisasiModel::class, 'anak_id', 'id');
    }

    public function statusImunisasi()
    {
        return $this->hasMany(StatusImunisasiModel::class, 'anak_id', 'id');
    }

    public function imunisasi()
    {
        return $this->hasOne(StatusImunisasiModel::class, 'anak_id', 'id')->latest();
    }



}