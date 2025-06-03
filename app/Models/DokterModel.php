<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterModel extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $fillable = [
        'users_id',
        'no_str',
        'spesialis',
        'biografi',
    ];
    public function users()
{
    return $this->belongsTo(UsersModel::class, 'users_id');
}

}
