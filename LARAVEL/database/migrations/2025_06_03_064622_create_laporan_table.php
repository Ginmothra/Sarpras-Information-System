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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('keterangan');
            $table->enum('kategori', ['siswa', 'kategori', 'barang', 'denda']);
            $table->enum('status',[
                // denda
                'input_denda', 
                'konfirmasi_denda',
                // barang
                'input_barang',
                'edit_barang', 
                'hapus_barang',
                // kategori
                'input_kategori',
                'edit_kategori',
                'hapus_kategori',
                // siswa
                'input_siswa',
                'edit_siswa',
                'hapus_siswa',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
