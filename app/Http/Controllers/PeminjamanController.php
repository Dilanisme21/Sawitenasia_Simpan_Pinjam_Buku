<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa tambahkan ini
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Daftar_Buku;

class PeminjamanController extends Controller
{
    //1. Menampilkan daftar riwayat transaksi peminjaman(Read)
    public function index(){
        // Mengambil data peminjaman beserta relasi anggota dan buku
        // $peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->paginate(5);

        // return view('peminjaman.index', compact('peminjaman'));

        $peminjaman = DB::table('peminjamen')
        // Gabungkan tabel peminjamen dengan anggotas
        ->join('anggotas', 'peminjamen.anggota_id', '=', 'anggotas.id')
        // Gabungkan tabel peminjamen dengan daftar__bukus
        ->join('daftar__bukus', 'peminjamen.buku_id', '=', 'daftar__bukus.id')
        // Pilih kolom yang mau dituju
        ->select(
            'peminjamen.id as id', //Negesin ini ID
            'peminjamen.*',
            'anggotas.no_anggota',
            'anggotas.nama_anggota',
            'daftar__bukus.no_registrasi_buku',
            'daftar__bukus.judul_buku'
        )
        ->orderBy('peminjamen.id', 'asc')
        ->paginate(5);

        return view('peminjaman.index', compact('peminjaman'));
    }

    // 2. Menampilkan form tambah transaksi pinjam buku
    public function form_create(){
        // 1.a. Ambil semua data anggota
        $anggotas = Anggota::all();

        // 2.a. Ambil data buku yang stoknya lebih dari 0
        $bukus = Daftar_Buku::where('jumlah_buku', '>', 0)->get();
        
        return view('peminjaman.registrasi', compact('anggotas', 'bukus'));
    }

    // 3. Menyimpan Data Peminjaman(Create)
    public function penyimpanan(Request $request){
        // 1.b. Validasi Input
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_id' => 'required|exists:daftar__bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // 2.b. Cari buku berdasarkan ID dan Cek Stok
        $buku = Daftar_Buku::findOrFail($request->buku_id);

        if($buku->jumlah_buku < 1){
            return redirect()->back()->with('error', 'Stok buku Habis!');
        }

        // 3.b. Simpan data transaksi Peminjaman Baru
        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        // 4.b. Otomatis kurangi stok buku
        $buku->decrement('jumlah_buku');
        // $buku -> jumlah_buku = $buku->jumlah_buku - 1;
        // $buku -> save
        // $buku -> jumlah_buku -= 1;
        // $buku -> save()

        // 5.b. Kembali ke tabel riwayat peminjaman
        return redirect()->route('peminjaman.index')->with('success', 'Transaksi Peminjaman Berhasil Dicatat!!');
    }

    // 4.b. Fitur Hapus(Delete)
    public function hapus($id){
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Dihapus');
    }

    // 5. Fitur Pengembalian Buku
    public function Kembalikan($id){
        // 5.a. Cari Data Transaksi Peminjaman
        $peminjaman = Peminjaman::findOrFail($id);

        // 5.b. Cek Agar Tidak Bisa Dikembalikan 2x
        if($peminjaman->status == 'Dikembalikan'){
            return redirect()->back()->with('error', 'Buku Ini Sudah Dikembalikan');
        }

        // 5.c. Ubah Status Pengembalian
        $peminjaman->update([
            'status' => 'Dikembalikan'
        ]);

        // 5.d. Tambah Kembali Stok Buku
        $buku = Daftar_Buku::findOrFail($peminjaman->buku_id);
        $buku->increment('jumlah_buku');

        return redirect()->route('peminjaman.index')
                ->with('success', 'Buku Berhasil Dikembalikan');
    }
}
