@extends('layouts.master')

@push('isi-halaman')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h2 class="text-center mb-5">Registrasi Peminjaman Buku</h2>
            <form action="{{route('peminjaman.simpan')}}" method="POST">
                @csrf 
                <div class="row align-items-center mb-2">
                    <div class="col-4">
                        <label for="no_anggota">Nama </label>
                    </div>
                    <div class="col-8 border-dark">
                        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control mb-2" required>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-4">
                        <label class="form-label mb-0">Jenis Kelamin</label>
                    </div>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-dark" type="radio" name="jenis_kelamin" id="jk_l" value="Pria" required>
                            <label class="form-check-label" for="jk_l">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-dark" type="radio" name="jenis_kelamin" id="jk_p" value="Wanita" required>
                            <label class="form-check-label" for="jk_p">Wanita</label>
                        </div>
                    </div>
                </div>    
                <div class="row align-items-center mb-3">
                    <div class="col-4">
                        <label for="alamat_rumah" class="form-label mb-0">Alamat Rumah</label>
                    </div>
                    <div class="col=8">
                        <textarea name="alamat_rumah" id="alamat_rumah" class="form-control border-dark" rows="3" placeholder="Masukkan Alamat Lengkap" required></textarea>
                    </div>
                </div> 
                <div class="row align-items-center mb-2">
                    <div class="col-4">
                        <label for="no_telepon">No. Telepon </label>
                    </div>
                    <div class="col-8 border-dark">
                        <input type="tel" name="no_telepon" id="no_telepon" class="form-control mb-2" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary mt-3">Simpan Data Buku</button>
                        <a href="{{route('peminjaman.index')}}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>         
            </form>
        </div>
    </div>
</div>
@endpush