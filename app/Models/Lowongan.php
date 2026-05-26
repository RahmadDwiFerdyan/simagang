<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lowongan extends Model
{

    use HasFactory;

    protected $fillable = [
        'dept_id', 
        'posisi',
        'quota',
        'deskripsi',
    ];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'id_lowongan');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'dept_id');
    }
}
