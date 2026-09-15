<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    //Menampilkan Data(Read)
    public function index(){
        $anggotas = Anggota::paginate(5);
        return view('anggota.index', compact('anggotas'));
    }
    // Menampilkan Form Tambah Data
    public function tambah_data(){
        return view('anggota.tambah_anggota');
    }
    // Menambah Data(Create)
    public function tambah_anggota(Request $request){
        $data = $request->validate([
            'no_anggota' => 'required',
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'no_telepon' => 'required'
        ]);

        Anggota::create($data);
        return redirect()->route("anggota.index")->with('success', 'Data Anggota Berhasil Ditambah');
    }
    // Mencari Data yang Mau Diubah(Update)
    public function ubah_anggota($id){
        $anggota = Anggota::findOrFail($id);
        return view('anggota.ubah_data_anggota', compact('anggota'));
    }
    // Mengubah Data Anggota(Update)
    public function update_anggota(Request $request, $id){
        $data = $request->validate([
            'no_anggota' => 'required',
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'no_telepon' => 'required'            
        ]);
        $anggota = Anggota::findOrFail($id);
        $anggota->update($data);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota Berhasil Diubah');
    }
    // Fitur Hapus(Delete)
    public function hapus_anggota($id){
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        
        // Tambah ->with('success', '...') 
        return redirect()->route('anggota.index')->with('success', 'Data Anggota Berhasil Dihapus');
    }
}
