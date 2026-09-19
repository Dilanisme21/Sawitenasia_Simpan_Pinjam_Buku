<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{

    protected $fillable = [
        'no_anggota',
        'nama_anggota',
        'jenis_kelamin',
        'alamat_rumah',
        'no_telepon'
    ];
}
