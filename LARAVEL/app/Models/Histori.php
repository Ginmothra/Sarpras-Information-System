<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    protected $table = 'histori';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nisn',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_sebenarnya',
        'status',
        'alasan_penolakan',
    ];
}
