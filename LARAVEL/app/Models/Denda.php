<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';
    protected $fillable = [
        'siswa_nisn',
        'jumlah',
        'admin',
        'status',
        'keterangan',
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nisn', 'nisn');
    }
}
