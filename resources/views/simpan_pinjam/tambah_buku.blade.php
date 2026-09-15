@extends('layouts.master')

@push("isi-halaman")

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Tambah Data Buku Baru</h2>
                <form action="{{route('simpan_pinjam.simpan_buku')}}" method="POST">
                        @csrf
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="no_registrasi_buku">No Registrasi Buku</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="text" name="no_registrasi_buku" id="no_registrasi_buku" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="judul_buku">Judul Buku</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="pengarang">Pengarang</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="text" name="pengarang" id="pengarang" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="penerbit">Penerbit</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="text" name="penerbit" id="penerbit" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="tahun_terbit">Tahun Terbit</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label for="jumlah_buku">Jumlah Buku</label>
                        </div>
                        <div class="col-8 border-dark">
                            <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary mt-3">Simpan Data Buku</button>
                            <a href="{{route('simpan_pinjam.index')}}" class="btn btn-secondary mt-3">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endpush