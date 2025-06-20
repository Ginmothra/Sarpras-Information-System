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
        Schema::create('barang', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode_barang')->unique();
            $table->string('nama');
            $table->string('admin');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('gambar');
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->enum('status', ['tersedia', 'pending', 'terpakai'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
