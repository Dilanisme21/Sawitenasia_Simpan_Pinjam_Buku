<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

// Route::get('/', function () {
//     return view('simpan_pinjam/index');
// });

// Route::get('/simpan_pinjam', [DaftarBukuController::class, 'index']);

// Ini Fitur Buku
Route::get('/', [DaftarBukuController::class, 'index'])->name('simpan_pinjam.index'); // Ini buat nampilin Index

Route::get('/simpan_pinjam/tambah_buku', [DaftarBukuController::class,'create'])
->name('simpan_pinjam.tambah_buku'); // Ini buat masuk ke form tambah

Route::post('/simpan_pinjam', [DaftarBukuController::class, 'simpan_buku'])
->name('simpan_pinjam.simpan_buku');// Ini buat posting data ke db trus ditampilin data

Route::get('/simpan_pinjam/{id}', [DaftarBukuController::class, 'edit_buku'])
->name('simpan_pinjam.edit_buku');// Ini buat masuk ke form edit

Route::put('/simpan_pinjam/{id}', [DaftarBukuController::class, 'update_buku'])
->name('simpan_pinjam.update_buku');// Ini buat posting data ke db trus ditampilin data

Route::delete('/simpan_pinjam/{id}',[DaftarBukuController::class, 'hapus_buku'])
->name('simpan_pinjam.hapus_buku');// Ini buat hapus aja si

// Ini Fitur Anggota
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

// Ini Fitur Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])
->name('peminjaman.index');

Route::get('/peminjaman/registrasi', [PeminjamanController::class, 'form_create'])
->name('peminjaman.registrasi');

Route::post('/peminjaman', [PeminjamanController::class], 'penyimpanan')
->name('peminjaman.simpan');