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
    Schema::create('histori', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang');
        $table->string('nama_barang');
        $table->string('nisn');
        $table->timestamp('tanggal_pinjam')->nullable();
        $table->timestamp('tanggal_kembali')->nullable();
        $table->timestamp('tanggal_sebenarnya')->nullable();
        $table->enum('status', ['rejected', 'accepted']);
        $table->text('alasan_penolakan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori');
    }
};
