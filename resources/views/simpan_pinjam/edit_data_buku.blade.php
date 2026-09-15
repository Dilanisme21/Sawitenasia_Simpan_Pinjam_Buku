@extends('layouts.master')

@push("isi-halaman")

    <div class="container">
        <h2 class="mt-3">Edit Buku</h2>
        <form action="{{route('simpan_pinjam.update_buku', $daftar_buku->id) }}" method="POST">
                @csrf
                @method('PUT')
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="no_registrasi_buku">No Registrasi Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="no_registrasi_buku" id="no_registrasi_buku" class="form-control mb-2">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="judul_buku">Judul Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="judul_buku" id="judul_buku" class="form-control mb-2">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="pengarang">Pengarang</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="pengarang" id="pengarang" class="form-control mb-2">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="penerbit">Penerbit</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="penerbit" id="penerbit" class="form-control mb-2">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="tahun_terbit">Tahun Terbit</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control mb-2">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-2">
                    <label for="jumlah_buku">Jumlah Buku</label>
                </div>
                <div class="col-4 border-dark">
                    <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control mb-2">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Data Buku</button>
        </form>
    </div>

@endpush