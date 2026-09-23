@extends('layouts.master')

@push('isi-halaman')
<div class="container my-4">
    <div class="row align-items-center">
        <h2 class="mt-4 text-center fw-bold">Peminjaman Buku</h2>

        <!-- Tabel Daftar Peminjaman -->
        <table class="table-striped-columns table-hover text-center table table-bordered">
            <thead class="table-info">
                <tr>
                    <th scope="col" style="width: 1%;">No </th>
                    <th scope="col" style="width: 10%;">Kode/Nama Anggota</th>
                    <th scope="col" style="width: 10%;">Kode/Judul Buku</th>
                    <th scope="col" style="width: 10%;">Tanggal Pinjam</th>
                    <th scope="col" style="width: 10%;">Tanggal Kembali</th>
                    <th scope="col" style="width: 8%;">Status</th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $p)
                <tr class="table-secondary">
                    <td>{{ $peminjaman->firstItem() + $loop->index }}</td>
                    <td>
                        <small class="text-muted">{{$p->no_anggota}}</small>
                        <strong>{{$p->nama_anggota}}</strong>
                    </td>
                    <td>
                        <small class="text-muted">{{$p->no_registrasi_buku}}</small>
                        <strong>{{$p->judul_buku}}</strong>
                    </td>
                    <td>{{ date('d-m-Y', strtotime($p->tanggal_pinjam))}}</td>
                    <td>{{ date('d-m-Y', strtotime($p->tanggal_kembali))}}</td>
                    <td>
                        @if($p->status == 'Dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        <form action='#' method="#" onsubmit="return confirm('Yakin hapus data ini')">
                            <!-- @csrf 
                            @method('DELETE') -->
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum Ada Buku yang Dipinjam</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $peminjaman->links() }}
        </div>

    </div>
    <div class="d-flex justify-content-center mt-3">
        <div class="btn-group" role="group">
            <a href="{{ route('peminjaman.registrasi') }}" class="btn btn-primary">Registrasi Peminjam</a>
            <a href="{{ route('simpan_pinjam.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endpush