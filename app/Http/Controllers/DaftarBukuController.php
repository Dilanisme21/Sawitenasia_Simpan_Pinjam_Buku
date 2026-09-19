<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar_Buku;

class DaftarBukuController extends Controller
{
    //
    // Menampilkan Data(Read)
    public function index(){
        $daftar_bukus = Daftar_Buku::paginate(5);
        return view('simpan_pinjam.index',compact('daftar_bukus'));
    }
    // Menampilkan Form Tambah(Create)
    public function create(){
        return view('simpan_pinjam.tambah_buku');
    }
    // Menyimpan Data Baru(Create)
    public function simpan_buku(Request $request){
        // 1. Validasi input(no_registrasi_buku dihilangkan karena dibikin otomotasi)
        $request->validate([
            // 'no_registrasi_buku' => 'required',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'genre' => 'required',
            'tahun_terbit' => 'required|numeric',
            'jumlah_buku' => 'required|integer',
        ]);

        // 2. Ambil nomor Urut dari ID data buku terakhir
        $lastBuku = Daftar_Buku::latest()->first(); //Sesuaikan modulnya
        $nextNumber = $lastBuku ? $lastBuku->id + 1:1;
        $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT); //Format: 001, 002, dll
        
        // 3. Ambi huruf depannya dan Tahun
        $hurufJudul = strtoupper(substr($request->judul_buku, 0, 2));
        $hurufPenerbit = strtoupper((substr($request->penerbit, 0, 2)));
        $hurufGenre = strtoupper(substr($request->genre, 0, 2));
        $tahunTerbit = substr($request->tahun_terbit, -2);

        // 4. Gabungkan format: 01/001/Je/Pe/Ge
        $no_registrasi_buku = "{$tahunTerbit}/{$nomorUrut}/{$hurufJudul}/{$hurufPenerbit}/{$hurufGenre}";

        Daftar_Buku::create([
            'no_registrasi_buku' => $no_registrasi_buku,
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'genre' => $request->genre,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku,
        ]);
        // Daftar_Buku::create($data);
        return redirect()->route('simpan_pinjam.index');
    }

    public function edit_buku($id){
        $daftar_buku = Daftar_Buku::findOrFail($id);
        return view('simpan_pinjam.edit_data_buku',compact('daftar_buku'));
    }

    public function update_buku(Request $request, $id){
        $data_buku = $request->validate([
            'no_registrasi_buku' => 'required',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required|integer'
        ]);

        $daftar_buku = Daftar_Buku::findOrFail($id);
        $daftar_buku->update($data_buku);

        return redirect()->route('simpan_pinjam.index');
    }

    public function hapus_buku($id){
        $daftar_buku = Daftar_Buku::findOrFail($id);
        $daftar_buku->delete();

        return redirect()->route('simpan_pinjam.index');
    }
}
