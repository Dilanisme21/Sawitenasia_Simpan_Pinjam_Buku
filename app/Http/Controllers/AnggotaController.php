<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    //Menampilkan Data(Read)
    public function index(Request $request){
        // 1. Mulai Query
        $query = Anggota::query();

        // 2. Jika ada kata kunci pencarian
        if ($request->has('search') && $request->search != ''){
            $query->where('nama_anggota', 'LIKE', "%" . $request->search . '%');
        }

        // 3. Pakai paginate dan tambah appends agar kata kunci terbatas
        $anggotas = $query->paginate(5)->appends($request->all());

        return view('anggota.index', compact('anggotas'));
    }

    // Menampilkan Form Tambah Data
    public function tambah_data(Request $request){
        return view('anggota.tambah_anggota');
    }
    
    // Menambah Data(Create)
    public function tambah_anggota(Request $request){
        $request->validate([
            // 'no_anggota' => 'required',
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'no_telepon' => 'required'
        ]);

        // 1. Tentukan Kode Depan(01/02) $ Kode Belakang (L/P)
        $isMale = in_array($request->jenis_kelamin,['Pria', 'Laki-Laki', 'L']);
        $kodeDepan = $isMale ? '01':'02';
        $kodeBelakang = $isMale ? 'L' : 'P';

        // 2. Ambil nomor urut increment dari ID Terakhir
        $lastAnggota = Anggota::latest()->first();
        $nextNumber = $lastAnggota ? $lastAnggota->id + 1 : 1;
        $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // Hasil: 001, 002, dst

        // 3. Gabungkan jadi satu format lengkap: 01/001/L
        $no_anggota = "{$kodeDepan}/{$nomorUrut}/{$kodeBelakang}";

        // 4. Simpan Database
        Anggota::create([
            'no_anggota' => $no_anggota,
            'nama_anggota' => $request->nama_anggota,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_rumah' => $request->alamat_rumah,
            'no_telepon' => $request->no_telepon,
        ]);

        // Anggota::create($data);
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
