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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('siswa_nisn',255);
            $table->string('kode_barang');
            $table->foreign('siswa_nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->string('nama_barang', 255);
            $table->text('alasan');
            $table->enum('status',['pending','diterima','ditolak','dikembalikan']);
            $table->dateTime('tanggal_pinjam');
            $table->dateTime('tanggal_kembali');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
