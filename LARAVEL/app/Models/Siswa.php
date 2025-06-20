<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasApiTokens,Notifiable;
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'admin',
        'username',
        'password',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'siswa_nisn', 'nisn');
    }

    public function denda()
    {
        return $this->hasMany(Denda::class, 'siswa_nisn', 'nisn');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
