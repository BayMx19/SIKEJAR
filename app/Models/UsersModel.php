<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UsersModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'nama',
        'NIK',
        'password',
        'role',
        'status',
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
}