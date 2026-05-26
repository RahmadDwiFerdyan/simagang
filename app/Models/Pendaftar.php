<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_lowongan',
        'name',
        'gender',
        'dob',
        'address',
        'no_telp',
        'university',
        'major',
        'ipk',
        'path_cv',
        'status'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
