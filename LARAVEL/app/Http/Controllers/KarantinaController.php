<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Histori;
use App\Models\Karantina;
use App\Models\Peminjaman;
use App\Models\Pengembalian;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KarantinaController extends Controller
{
    public function index(){
        $barangKarantina = Karantina::all();
        return view('subview.karantina',compact('barangKarantina'));
    }
    public function kirim($id){
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = Peminjaman::findOrFail($pengembalian->peminjaman_id);
        Karantina::create([
            'nama_barang' => $pengembalian->nama_barang,
            'kode_barang' => $pengembalian->kode_barang,
            'kondisi_barang' => $pengembalian->kondisi_barang,
            'alasan_kerusakan' => $pengembalian->catatan,
        ]);

        Histori::create([
            'kode_barang' => $pengembalian->kode_barang,
            'nama_barang' => $pengembalian->nama_barang,
            'nisn' => $pengembalian->nisn,
            'status' => 'accepted',
            'tanggal_pinjam' => $pengembalian->tanggal_peminjaman,
            'tanggal_kembali' => $pengembalian->tanggal_pengembalian,
            'tanggal_sebenarnya' => $pengembalian->created_at
        ]);
        
        if ($pengembalian->bukti_pengembalian && Storage::exists('public' . $pengembalian->bukti_pengembalian))
        {
            Storage::delete('public' . $pengembalian->bukti_pengembalian);
        }
        $barang = Barang::findOrFail($pengembalian->barang_id);
        $barang->kondisi = 'rusak';
        $barang->save();
        $pengembalian->delete();
        $peminjaman->delete();
        return redirect()->route('karantina.index');
    }

    public function done($id){
        $karantina = Karantina::findOrFail($id);
        $barang = Barang::where('kode_barang',$karantina->kode_barang)->firstOrFail();
        $barang->kondisi = 'baik';
        $barang->status = 'tersedia';
        $barang->save();
        $karantina->delete();
        Alert::success('Berhasil', 'Barang berhasil diperbaiki');
        return redirect()->route('karantina.index');
    }
}
