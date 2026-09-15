<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBukuController;
use App\Http\Controllers\AnggotaController;

// Route::get('/', function () {
//     return view('simpan_pinjam/index');
// });

// Route::get('/simpan_pinjam', [DaftarBukuController::class, 'index']);

Route::get('/', [DaftarBukuController::class, 'index'])->name('simpan_pinjam.index');

Route::get('/simpan_pinjam/tambah_buku', [DaftarBukuController::class,'create'])
->name('simpan_pinjam.tambah_buku');

Route::post('/simpan_pinjam', [DaftarBukuController::class, 'simpan_buku'])
->name('simpan_pinjam.simpan_buku');

Route::get('/simpan_pinjam/{id}', [DaftarBukuController::class, 'edit_buku'])
->name('simpan_pinjam.edit_buku');

Route::put('/simpan_pinjam/{id}', [DaftarBukuController::class, 'update_buku'])
->name('simpan_pinjam.update_buku');

Route::delete('/simpan_pinjam/{id}',[DaftarBukuController::class, 'hapus_buku'])
->name('simpan_pinjam.hapus_buku');

Route::get('/anggota', [AnggotaController::class, 'index'])
->name('anggota.index');

Route::get('/anggota/tambah_anggota', [AnggotaController::class, 'tambah_data'])
->name('anggota.tambah_data');

Route::post('/anggota', [AnggotaController::class, 'tambah_anggota'])
->name('anggota.tambah_anggota');

Route::get('/anggota/{id}', [AnggotaController::class, 'ubah_anggota'])
->name('anggota.ubah_anggota');

Route::put('/anggota/{id}', [AnggotaController::class, 'update_anggota'])
->name('anggota.update_anggota');

Route::delete('/anggota/{id}', [AnggotaController::class, 'hapus_anggota'])
->name('anggota.hapus_anggota');