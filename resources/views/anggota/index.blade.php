@extends('layouts.master')

@push('isi-halaman')
    <div class="container my-4">
        <div class="row align-items-center">
        <h2 class="mt-4 text-center fw-bold">Daftar Anggota Simpan Pinjam Buku</h2>
        <!-- Form Search  -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{route('anggota.index')}}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" 
                        class="form-control border-dark" 
                        placeholder="Cari nama anggota..."
                        value="{{request('search') }}">
                    <button class="btn btn-outline-dark" type="submit">Cari</button>
                    <!-- Tombol Reset muncul cuma pas lagi nyari -->
                    @if(request('search'))
                        <a href="{{ route('anggota.index')}}" class="btn btn-outline-danger">Reset</a>
                    @endif
                    </div>
                </form>
                <!-- Pesan Indikator Pencarian -->
                 @if(request('search'))
                    <small class="text-muted mt-1 d-block">
                        Menampilkan hasil pencarian untuk: <strong>"{{request('search')}}"</strong>
                    </small>
                 @endif
            </div>
        </div> 
            <table class="table-striped-columns text-center table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 1%;">No</th>
                        <th scope="col" style="width: 8%;">No Anggota</th>
                        <th scope="col" style="width: 12%;">Nama Anggota</th>
                        <th scope="col" style="width: 7%;">Jenis Kelamin</th>
                        <th scope="col" style="width: 12%;">Alamat Rumah</th>
                        <th scope="col" style="width: 10%;">No Telepon</th>
                        <th scope="col" style="width: 12%;">Action</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    @foreach($anggotas as $index => $anggota)
                    <tr>
                        <td>{{$anggotas->firstItem() + $index}}</td>
                        <td>{{$anggota->no_anggota}}</td>
                        <td>{{$anggota->nama_anggota}}</td>
                        <td>{{$anggota->jenis_kelamin}}</td>
                        <td>{{$anggota->alamat_rumah}}</td>
                        <td>{{$anggota->no_telepon}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('anggota.ubah_anggota', $anggota->id) }}" class="btn btn-info">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$anggota->id}}">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{$anggota->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$anggota->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{$anggota->id}}">Konfirmasi Hapus Data</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    Apakah kamu yakin ingin menghapus data anggota <strong>{{$anggota->nama_anggota}}</strong> dengan nomor (No: {{ $anggota->no_anggota }})?
                                    <br>
                                    <small class="text-muted">*Data yang dihapus tidak dapat dikembalikan lagi</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('anggota.hapus_anggota', $anggota->id) }}" method="POST" class="d-inline">
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
            {{ $anggotas->links() }}
        </div>

    </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="btn-group" role="group">
                <a href="{{ route('anggota.tambah_data') }}" class="btn btn-primary">Tambah Anggota</a>
                <a href="{{ route('simpan_pinjam.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

@endpush
