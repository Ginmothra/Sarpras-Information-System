<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'keterangan',
        'kategori',
        'status',
    ];
}
