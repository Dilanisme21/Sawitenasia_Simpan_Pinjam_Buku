<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel anggota dan buku
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('daftar__bukus')->onDelete('cascade');

            // Tanggal Transaksi
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            // Status Peminjaman
            $table->enum('status', ['Dipinjam', 'Dikembalikan'])->default('Dipinjam');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
