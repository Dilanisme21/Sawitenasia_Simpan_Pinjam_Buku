<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    //
    use HasFactory;

    // Menegaskan nama tabel di database
    protected $table = 'peminjamen';

    // Kolom yang diisi scr massal via controller
    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    // Relasi ke Model Anggota(Satu peminjaman dimiliki satu anggota)
    public function anggota(){
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // Relasi ke Model Buku(Satu peminjaman mencatat satu buku)
    public function buku(){
        return $this->belongsTo(Daftar_Buku::class, 'buku_id');
    }
}
