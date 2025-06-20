<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nisn')->primary();
            $table->string('admin');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
