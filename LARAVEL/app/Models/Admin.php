<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin'; // pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
