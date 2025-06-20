<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karantina extends Model
{   
    protected $table = 'karantina';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kondisi_barang',
        'alasan_kerusakan'
    ];
}
