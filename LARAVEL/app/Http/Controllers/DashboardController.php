<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Denda;
use App\Models\Karantina;
use App\Models\Siswa;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){
        $peminjaman = Peminjaman::where('status','pending')->count();
        $pengembalian = Peminjaman::where('status','dikembalikan')->count();
        $tersedia = Barang::where('status','tersedia')->where('kondisi','baik')->count();
        $terpakai = Barang::where('status','terpakai')->count();
        $karantina = Karantina::count();
        $topDenda = Denda::with('siswa')
        ->select('siswa_nisn', DB::raw('SUM(jumlah) as total_denda'))
        ->where('status','belum_lunas')
        ->groupBy('siswa_nisn')
        ->orderByDesc('total_denda')
        ->limit(5)
        ->get();
        return view('page.dashboard',compact('peminjaman','pengembalian','topDenda','tersedia','terpakai','karantina'));
    }
}
