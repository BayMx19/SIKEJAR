<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersModel extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'nama',
        'NIK',
        'nomor_telepon',
        'alamat',
        'RT',
        'RW',
        'password',
        'role',
        'status',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function anak()
    {
        return $this->belongsTo(AnakModel::class, 'users_id', 'id');
    }

    public function feedback()
    {
        return $this->belongsTo(FeedbackModel::class, 'users_id', 'id');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function dokter()
    {
        return $this->hasOne(DokterModel::class, 'users_id');
    }

}
