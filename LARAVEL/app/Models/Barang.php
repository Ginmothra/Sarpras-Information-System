<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'nama',
        'admin',
        'karantina_id',
        'kategori_id',
        'gambar',
        'kondisi',
        'status',
    ];
    protected $table = 'barang';
    protected $primaryKey = 'id';

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'barang_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'kategori_id');
    }
}
