@extends('layouts.master')

@push('isi-halaman')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h2 class="text-center mb-5">Registrasi Peminjaman Buku</h2>
            <form action="{{route('peminjaman.simpan')}}" method="POST">
            <!-- Pesan Error Validasi / Stok Habis -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                @csrf 
                <!-- 1. Pilih Anggota -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Anggota</label>
                    <select name="anggota_id" class="form-select" required>
                        <option value="">--Pilih Anggota--</option>
                        @foreach($anggotas as $a)
                            <option value="{{$a->id}}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                {{ $a->no_anggota }} - {{ $a->nama_anggota }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- 2. Pilih Judul Buku -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Buku</label>
                    <select name="buku_id" class="form-select" required>
                    <option value="">--Pilih Buku--</option>
                        @foreach($bukus as $b)
                            <option value="{{$b->id}}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->no_registrasi_buku }} - {{ $b->judul_buku }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- 3. Tanggal Pinjam dan Kembali -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Pinjam</label>
                        <!-- Default di isi tanggal hari ini -->
                         <input type="date" name="tanggal_pinjam" class="form-control"
                                value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Wajib Kembali</label>
                        <!-- Default otomatis 14 hari dari tanggal pinjam -->
                         <input type="date" name="tanggal_kembali" class="form-control"
                                value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+14 days'))) }}" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <a href="{{route('peminjaman.index')}}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>         
            </form>
        </div>
    </div>
</div>
@endpush