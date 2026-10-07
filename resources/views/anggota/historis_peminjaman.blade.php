@extends('layouts.master')

@push('isi-halaman')
<div class="container my-4">
    <!-- 1. Kartu Informasi Anggota -->
    <div class="card mb-4 shadow-sm border=0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 fw-bold">Profil dan Ringkasan Anggota</h4>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td style="width: 30%;" class="fw-bold">No Anggota</td>
                            <td>: <span class="badge bg-secondary">{{$anggota->no_anggota}}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;" class="fw-bold">Nama Lengkap</td>
                            <td>: <span class="badge bg-secondary">{{$anggota->nama_anggota}}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;" class="fw-bold">Jenis Kelamin</td>
                            <td>: <span class="badge bg-secondary">{{$anggota->jenis_kelamin}}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;" class="fw-bold">Alamat Rumah</td>
                            <td>: <span class="badge bg-secondary">{{$anggota->alamat_rumah}}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;" class="fw-bold">No Telepon</td>
                            <td>: <span class="badge bg-secondary">{{$anggota->no_telepon}}</span></td>
                        </tr>
                    </table>
                    <div class="col-md-5 border-start text-center">
                        <small class="text-muted d-block">Status Pinjaman Aktif</small>
                        <h3 class="fw-bold">
                            {{ $histori->where('status', 'Dipinjam')->count() }} <small class="fs-6 text-dark">Buku Dipinjam</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Tabel Riwayat Peminjaman -->
     <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h4 class="mb-0 fw-bold">Riwayat Peminjaman Buku</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover text-center align-middle mb-0">
                <thead class="table-info">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 35%;">Kode & Judul Buku</th>
                        <th style="width: 20%;">Tanggal Peminjaman</th>
                        <th style="width: 20%;">Tanggal Pengembalian</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histori as $p)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-start ps-4">
                            <small class="text-muted">{{ $p->no_registrasi_buku }}</small>
                            <strong>{{ $p->judul_buku ?? 'Buku Tidak Ditemukan'}}</strong>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggal_pinjam)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggal_kembali)) }}</td>
                        <td>
                            @if($p->status == 'Dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Anggota ini belum pernah pinjam buku </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        <div class="mt-3">
            {{ $histori->links() }}
        </div>
        </div>
     </div>
    <div class="d-flex justify-content-center mt-3">
        <div class="btn-group" role="group">
            <a href="{{route('anggota.index')}}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div> 
</div>
@endpush