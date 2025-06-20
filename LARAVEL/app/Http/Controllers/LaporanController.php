<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function denda(){
        $logs = Laporan::where('kategori', '=', 'denda')->paginate(10);
        return view('report.laporan-denda', compact('logs'));
    }
    public function barang(){
        $logs = Laporan::where('kategori', '=', 'barang')->paginate(10);
        return view('report.laporan-barang', compact('logs'));
    }
    public function kategori(){
        $logs = Laporan::where('kategori', '=', 'kategori')->paginate(10);
        return view('report.laporan-kategori', compact('logs'));
    }
    public function siswa(){
        $logs = Laporan::where('kategori', '=', 'siswa')->paginate(10);
        return view('report.laporan-siswa',compact('logs')) ;
    }
}
