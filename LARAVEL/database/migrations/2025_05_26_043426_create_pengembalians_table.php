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
    Schema::create('pengembalian', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('peminjaman_id');
        $table->string('kode_barang');
        $table->unsignedBigInteger('barang_id');
        $table->string('nisn');
        $table->string('nama_pengembali');
        $table->dateTime('tanggal_peminjaman');
        $table->dateTime('tanggal_pengembalian');
        $table->text('catatan')->nullable();
        $table->string('nama_barang');
        $table->enum('kondisi_barang', ['baik', 'rusak']);
        $table->string('bukti_pengembalian');
        $table->timestamps();

        $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
        $table->foreign('barang_id')->references('id')->on('barang');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
