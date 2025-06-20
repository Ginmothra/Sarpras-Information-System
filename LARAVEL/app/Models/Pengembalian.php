<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'kode_barang',
        'peminjaman_id',
        'barang_id',
        'nisn',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'nama_pengembali',
        'catatan',
        'nama_barang',
        'kondisi_barang',
        'bukti_pengembalian'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
