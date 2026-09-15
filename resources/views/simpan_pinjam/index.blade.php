@extends('layouts.master')

@push('isi-halaman')
    <div class="container my-4">
        <div class="row align-items-center">
        <h2 class="mt-4 text-center fw-bold">Sistem Administrasi Simpan Pinjam Buku</h2>
            <table class="table-striped-columns text-center table table-bordered ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 1%;">No</th>
                        <th scope="col" style="width: 10%;">No Registrasi Buku</th>
                        <th scope="col" style="width: 15%;">Judul Buku</th>
                        <th scope="col" style="width: 15%;">Pengarang</th>
                        <th scope="col" style="width: 10%;">Penerbit</th>
                        <th scope="col" style="width: 5%;">Tahun</th>
                        <th scope="col" style="width: 7%;">Jumlah</th>
                        <th scope="col" style="width: 13%;">Action</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    @foreach($daftar_bukus as $index => $daftar_buku)
                    <tr>
                        <td>{{ $index + 1}}</td>
                        <td>{{ $daftar_buku->no_registrasi_buku }}</td>
                        <td class="text-start fw-semibold">{{ $daftar_buku->judul_buku}}</td>
                        <td>{{$daftar_buku->pengarang}}</td>
                        <td>{{$daftar_buku->penerbit}}</td>
                        <td>{{$daftar_buku->tahun_terbit}}</td>
                        <td>{{$daftar_buku->jumlah_buku}}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('simpan_pinjam.edit_buku', $daftar_buku->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('simpan_pinjam.hapus_buku', $daftar_buku->id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form> 
                            </div>
  
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="btn-group" role="group">
                <a href="{{ route('simpan_pinjam.tambah_buku') }}" class="btn btn-primary">Tambah Data Buku Baru</a>
                <button type="button" class="btn btn-danger">Peminjaman Buku</button>
                <a href="{{ route('anggota.index') }}" class="btn btn-warning">Daftar Anggota</a>
                <button type="button" class="btn btn-success">Informasi</button>
            </div>
        </div>
@endpush
