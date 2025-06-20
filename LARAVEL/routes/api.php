<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\HistoriApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Http\Controllers\Api\PengembalianApiController;
use App\Http\Controllers\Api\ProfileApiController;

Route::post('/login', [SiswaController::class, 'login']);
Route::middleware([ApiMiddleware::class])->group(function (){
    Route::post('/logout', [SiswaController::class, 'logout']);
    
    // ROUTE HOME
    Route::get('/barang', [BarangApiController::class, 'index']);
    
    // ROUTE PEMINJAMAN
    Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
    Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);

    // ROUTE PENGEMBALIAN
    Route::post('/pengembalian', [PengembalianApiController::class, 'store']);

    // ROUTE HISTORI
    Route::get('/histori', [HistoriApiController::class, 'index']);

    // ROUTE PROFILE
    Route::get('/profile',[ProfileApiController::class, 'profile']);
    Route::get('/logout',[ProfileApiController::class, 'logout']);
});

