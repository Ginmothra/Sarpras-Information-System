<?php

use App\Http\Controllers\KarantinaController;
use App\Http\Middleware\CekLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

// ROUTE GET

// ROUTE LOGIN
Route::get('/', function () {
    return view('login');
});

// ROUTE DASHBOARD
Route::middleware([CekLogin::class])->group(function () {

Route::prefix('dashboard')->group(function () {
    Route::get('',[DashboardController::class, 'index']);
    

    // ROUTE PEMINJAMAN
    Route::prefix('peminjaman')->group(function () {
        Route::get('',[PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/form',[PeminjamanController::class,'request'])->name('peminjaman.request');
        Route::post('/acc/{id}', [PeminjamanController::class, 'acc'])->name('peminjaman.acc');
        Route::post('/reject/{id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    });

    // ROUTE PENGEMBALIAN
    Route::prefix('pengembalian')->group(function () {
        Route::get('', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/detail/{id}', [PengembalianController::class, 'detail'])->name('pengembalian.detail');
        Route::post('/acc/{id}', [PengembalianController::class, 'accPengembalian'])->name('pengembalian.acc');
    });

// ROUTE BARANG
    Route::prefix('data-barang')->group(function () {
        Route::get('', [BarangController::class, 'index'])->name('index.barang');
        Route::get('/tambah', [BarangController::class,'form'])->name('index.tambah-barang');
        Route::get('/search',[BarangController::class, 'search'])->name('search.barang');
        Route::get('/filter',[BarangController::class, 'filter'])->name('filter.barang');
        Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('edit.barang');
        Route::post('/update/{id}', [BarangController::class, 'update'])->name('update.barang');
        Route::post('/delete/{id}', [BarangController::class, 'destroy'])->name('delete.barang');
        Route::post('/tambah', [BarangController::class, 'create'])->name('tambah.barang');
        Route::get('/export', [BarangController::class, 'export'])->name('export.barang');

// ROUTE KARANTINA
    Route::prefix('karantina')->group(function(){
        Route::get('',[KarantinaController::class, 'index'])->name('karantina.index');
        Route::post('/done/{id}',[KarantinaController::class, 'done'])->name('karantina.done');
        Route::post('/tambah/{id}', [KarantinaController::class, 'kirim'])->name('karantina.input');
    });
});

    // ROUTE KATEGORI
    Route::prefix('data-kategori')->group(function () {
        Route::get('', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/tambah',[KategoriController::class, 'store'])->name('kategori.store');
        Route::post('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::post('/delete/{id}',[KategoriController::class,'destroy'])->name('kategori.delete');
    });

    // ROUTE DENDA
    Route::prefix('data-denda')->group(function () {
       Route::get('', [DendaController::class, 'index'])->name('index.denda');
       Route::get('/detail/{nisn}', [DendaController::class, 'detail'])->name('detail.denda');
       Route::get('/form/{nisn}', [DendaController::class, 'form'])->name('form.denda');
       Route::post('/form/insert', [DendaController::class, 'insert'])->name('insert.denda');
       Route::post('/form/acc/{id}', [DendaController::class, 'acc'])->name('acc.denda');
    });
});

    // ROUTE LAPORAN
    Route::prefix('laporan')->group(function () {
        Route::get('/laporan-denda', [LaporanController::class, 'denda'])->name('laporan.denda');
        Route::get('/laporan-barang', [LaporanController::class, 'barang'])->name('laporan.barang');
        Route::get('/laporan-kategori', [LaporanController::class, 'kategori'])->name('laporan.kategori');
        Route::get('/laporan-siswa', [LaporanController::class, 'siswa'])->name('laporan.siswa');
});

    // ROUTE SISWA
    Route::prefix('siswa')->group(function () {
        Route::get('', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/tambah', function(){
            return view('register');
            })->name('index.siswa.tambah');
        Route::get('/search', [SiswaController::class, 'search'])->name('siswa.search');
        Route::get('/edit/{nisn}', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::post('/update/{nisn}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::post('/delete/{nisn}', [SiswaController::class, 'destroy'])->name('siswa.delete');
        Route::post('/tambah/siswa', [SiswaController::class, 'register'])->name('siswa.tambah');
        Route::get('/export', [SiswaController::class, 'export'])->name('siswa.export');
    });
});
// ROUTE GENERAL
Route::post('/login', [LoginController::class, 'Login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');