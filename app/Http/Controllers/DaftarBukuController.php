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
        $data = $request->validate([
            'no_registrasi_buku' => 'required',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required|integer',
        ]);
        Daftar_Buku::create($data);
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
