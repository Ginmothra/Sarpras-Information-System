<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Histori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function index(){
        $minjams = Peminjaman::with(['barang', 'siswa'])
        ->where('status','pending')
        ->orWhereHas('barang',function($query){
            $query->where('status','terpakai');
        })
        ->paginate(5);

    return view('Page.peminjaman', compact('minjams'));
    }
    public function request(){
        $peminjamans = Peminjaman::with(['barang', 'siswa'])
        ->where('status','pending')->paginate(5);
        return view('Subview.req-peminjaman',compact('peminjamans'));
    }

    public function acc($id)
    {  
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = Barang::findOrFail($peminjaman->barang_id);
        $peminjaman->status = 'diterima';
        $peminjaman->save();

        $barang->status = 'terpakai';
        $barang->save();
        Alert::success('Berhasil', 'Peminjaman berhasil disetujui');
        return redirect()->route('peminjaman.index');
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);
        $barang = Barang::findOrFail($peminjaman->barang_id);
        $barang->status = 'tersedia';
        $barang->save();

        Histori::create([
        'kode_barang' =>$barang->kode_barang,
        'nama_barang' => $peminjaman->nama_barang,
        'nisn' => $peminjaman->siswa_nisn,
        'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
        'tanggal_kembali' => $peminjaman->tanggal_kembali,
        'status' => 'rejected',
        'alasan_penolakan' => $request->alasan_penolakan,
    ]);

        $peminjaman->delete();
        Alert::success('Berhasil', 'Peminjaman berhasil ditolak');
        return redirect()->route('peminjaman.index');
    }
}
