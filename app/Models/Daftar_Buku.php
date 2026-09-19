<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daftar_Buku extends Model
{
    //
    protected $fillable = [
        'no_registrasi_buku',
        'judul_buku',
        'pengarang',
        'penerbit',
        'genre',
        'tahun_terbit',
        'jumlah_buku'
    ];
}
