@extends('layouts.master')

@push('isi-halaman')
    <div class="container my-4">
        <div class="row align-items-center">
        <h2 class="mt-4 text-center fw-bold">Sistem Administrasi Simpan Pinjam Buku</h2>
        
        <!-- Form Search -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{route('simpan_pinjam.index')}}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control border-dark"
                            placeholder="Ketik yang ingin dicari... " value="{{request('search')}}">
                        <button class="btn btn-outline-dark" type="submit">Cari</button>
                        <!-- Tombol Reset -->
                         @if(request('search'))
                            <a href="{{ route('simpan_pinjam.index') }}" class="btn btn-outline-danger">Reset</a>
                         @endif 
                    </div>
                </form>
                <!-- Pesan Indikator Pencarian -->
                 @if(request('search'))
                    <small class="text-muted mt-1 d-block">
                        Menampilkan hasil pencarian untuk: <strong>{{request('search')}}</strong>
                    </small>
                 @endif 
            </div>
        </div>
            <table class="table-striped-columns text-center table table-bordered ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 1%;">No</th>
                        <th scope="col" style="width: 10%;">No Registrasi Buku</th>
                        <th scope="col" style="width: 15%;">Judul Buku</th>
                        <th scope="col" style="width: 15%;">Pengarang</th>
                        <th scope="col" style="width: 10%;">Penerbit</th>
                        <th scope="col" style="width: 8%;">Genre</th>
                        <th scope="col" style="width: 5%;">Tahun</th>
                        <th scope="col" style="width: 7%;">Jumlah</th>
                        <th scope="col" style="width: 13%;">Action</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    @foreach($daftar_bukus as $index => $daftar_buku)
                    <tr>
                        <td>{{ $daftar_bukus->firstItem() + $loop->index }}</td>
                        <td>{{ $daftar_buku->no_registrasi_buku }}</td>
                        <td class="text-start fw-semibold">{{ $daftar_buku->judul_buku}}</td>
                        <td>{{$daftar_buku->pengarang}}</td>
                        <td>{{$daftar_buku->penerbit}}</td>
                        <td>{{$daftar_buku->genre}}</td>
                        <td>{{$daftar_buku->tahun_terbit}}</td>
                        <td>{{$daftar_buku->jumlah_buku}}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('simpan_pinjam.edit_buku', $daftar_buku->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <!-- <form action="{{ route('simpan_pinjam.hapus_buku', $daftar_buku->id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form> 
                            </div> -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$daftar_buku->id}}">
                                Delete
                            </button>
                        </td> 
                    </tr>

                    <div class="modal fade" id="deleteModal{{$daftar_buku->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$daftar_buku->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{$daftar_buku->id}}">Konfirmasi Hapus Data</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    Apakah kamu yakin menghapus data buku <strong>{{$daftar_buku->nama_buku}}</strong> dengan nomor buku {{$daftar_buku->no_registrasi_buku}} ??
                                    <small class="text-muted">Data yang dihapus tidak dapat dikembalikan kembali</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('simpan_pinjam.hapus_buku', $daftar_buku->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus Data</button>
                                    </form>  
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $daftar_bukus->links() }}
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="btn-group" role="group">
                <a href="{{ route('simpan_pinjam.tambah_buku') }}" class="btn btn-primary">Tambah Buku Baru</a>
                <button type="button" class="btn btn-danger">Peminjaman Buku</button>
                <a href="{{ route('anggota.index') }}" class="btn btn-warning">Anggota</a>
                <button type="button" class="btn btn-success">Informasi</button>
            </div>
        </div>
@endpush
