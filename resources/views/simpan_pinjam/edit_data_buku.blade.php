@extends('layouts.master')

@push("isi-halaman")

    <div class="container py-5">
        <h2 class="mt-3">Edit Buku</h2>
        <form action="{{route('simpan_pinjam.update_buku', $daftar_buku->id) }}" method="POST">
                @csrf
                @method('PUT')
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="no_registrasi_buku">No Registrasi Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="no_registrasi_buku" id="no_registrasi_buku" class="form-control mb-2"
                    value="{{old('no_registrasi_buku', $daftar_buku->no_registrasi_buku) }}" readonly >
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="judul_buku">Judul Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="judul_buku" id="judul_buku" class="form-control mb-2"
                    value="{{old('judul_buku', $daftar_buku->judul_buku) }}">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="pengarang">Pengarang</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="pengarang" id="pengarang" class="form-control mb-2"
                    value="{{old('pengarang', $daftar_buku->pengarang) }}">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="penerbit">Penerbit</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="penerbit" id="penerbit" class="form-control mb-2"
                    value="{{old('penerbit', $daftar_buku->penerbit) }}">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="genre">Genre</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="genre" id="genre" class="form-control mb-2"
                    value="{{old('genre', $daftar_buku->genre) }}">
                </div>
            </div>        
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="tahun_terbit">Tahun Terbit</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control mb-2"
                    value="{{old('tahun_terbit', $daftar_buku->tahun_terbit) }}">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="jumlah_buku">Jumlah Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control mb-2"
                    value="{{old('jumlah_buku', $daftar_buku->jumlah_buku) }}">
                </div>
            </div>
                <div class="d-flex justify-content-left mt-3">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary mt-3">Simpan Data Buku</button>
                        <a href="{{route('simpan_pinjam.index')}}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>  
        </form>
    </div>

@endpush