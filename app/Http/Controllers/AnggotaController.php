<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB; // Function buat aktifin database

class AnggotaController extends Controller
{
    //Menampilkan Data(Read)
    public function index(Request $request){
        // // 1. Mulai Query
        // $query = Anggota::query();

        // // 2. Jika ada kata kunci pencarian
        // if ($request->has('search') && $request->search != ''){
        //     $query->where('nama_anggota', 'LIKE', "%" . $request->search . '%');
        // }

        // // 3. Pakai paginate dan tambah appends agar kata kunci terbatas
        // $anggotas = $query->paginate(5)->appends($request->all());

        // return view('anggota.index', compact('anggotas'));

        // 1. Buat query search
        $keyword = $request->input('search');

        // 2. Ambil data anggotas dari database dengan query buat cari
        $anggota = DB::table('anggotas')
            ->when($keyword, function($query, $keyword){
                return $query->where('nama_anggota', 'LIKE', "%{$keyword}%")
                    ->orWhere('no_anggota', 'LIKE', "%{$keyword}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(5);
        
        // 3. Kembali ke view index dengan data anggotas
        return view('anggota.index', compact('anggota'));
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

        // 2. [ADA YANG DIUBAH]Ambil nomor urut increment dari ID Terakhir
        // $lastAnggota = Anggota::latest()->first();
        $lastAnggota = DB::table('anggotas')->orderBy('id', 'asc')->first();
        $nextNumber = $lastAnggota ? $lastAnggota->id + 1 : 1;
        $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // Hasil: 001, 002, dst

        // 3. Gabungkan jadi satu format lengkap: 01/001/L
        $no_anggota = "{$kodeDepan}/{$nomorUrut}/{$kodeBelakang}";

        // 4. [ADA YANG DIUBAH] Simpan Database
        // Anggota::create([
        //     'no_anggota' => $no_anggota,
        //     'nama_anggota' => $request->nama_anggota,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'alamat_rumah' => $request->alamat_rumah,
        //     'no_telepon' => $request->no_telepon,
        // ]);
        DB::table('anggotas')->insert([
            'no_anggota' => $no_anggota,
            'nama_anggota' => $request->nama_anggota,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_rumah' => $request->alamat_rumah,
            'no_telepon' => $request->no_telepon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Anggota::create($data);
        return redirect()->route("anggota.index")->with('success', 'Data Anggota Berhasil Ditambah');
    }

    // Mencari Data yang Mau Diubah(Update) [ADA YANG DIUBAH]
    public function ubah_anggota($id){
        // $anggota = Anggota::findOrFail($id);
        // [DIUBAH] Cari data pake Query Builder
        $anggota = DB::table('anggotas')->where('id', $id)->first();

        // Cek jika data gak ada di DB
        if(!$anggota){
            abort(404);
        }
        
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
        // $anggota = Anggota::findOrFail($id);
        // [DIUBAH] Tambahkan timestamp manual
        $data['updated_at'] = now();

        // [DIUBAH] Update Pakai Query Builder
        DB::table('anggotas')->where('id', $id)->update($data);
        // $anggota->update($data);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota Berhasil Diubah');
    }
    // Fitur Hapus(Delete)
    public function hapus_anggota($id){
        // [TAMBAHAN] Cek masih ada pinjaman aktif tidak
        $adaPinjaman = DB::table('peminjamen')
            ->where('anggota_id', $id)
            ->where('status', 'Dipinjam')
            ->exists();
        
        if($adaPinjaman){
            return redirect()->back()->with('error', 'Gagal Hapus! Anggota masih memiliki pinjaman aktif!');
        }

        // [DIRUBAH] Hapus pakai Query Builder
        DB::table('anggotas')->where('id', $id)->delete();
        // $anggota = Anggota::findOrFail($id);
        // $anggota->delete();
        
        // Tambah ->with('success', '...') 
        return redirect()->route('anggota.index')->with('success', 'Data Anggota Berhasil Dihapus');
    }

    // 
    // Historis Para Peminjam
    public function historis_peminjaman($id){
        // 1. Ambil dari data anggotanya
        $anggota = DB::table('anggotas')->where('id', $id)->first();

        // Jika data tidak ditemukan
        if(!$anggota){
            abort(404);
        }

        // 2. Ambil riwayat peminjaman + join ke tabel daftar__bukus
        $histori = DB::table('peminjamen')
            ->join('daftar__bukus', 'peminjamen.buku_id', '=', 'daftar__bukus.id') // Sesuaikan 'buku_id' dgn nama kolom di tabel peminjaman
            ->where('peminjamen.anggota_id', $id) // sesuaikan 'anggota_id'
            ->select(
                'peminjamen.*',
                'daftar__bukus.no_registrasi_buku',
                'daftar__bukus.judul_buku'
            )
            ->orderBy('peminjamen.id', 'asc')
            // ->get()
            ->paginate(2);

        return view('anggota.historis_peminjaman', compact('anggota', 'histori'));
    }
}
