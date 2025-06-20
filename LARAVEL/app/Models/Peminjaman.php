<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];
    protected $fillable = [
        'kode_barang',
        'siswa_nisn',
        'barang_id',
        'nama_barang',
        'alasan',
        'status',
        'tanggal_pinjam',
        'tanggal_kembali',
        'alasan_penolakan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nisn','nisn');
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class,'peminjaman_id');
    } 
}
