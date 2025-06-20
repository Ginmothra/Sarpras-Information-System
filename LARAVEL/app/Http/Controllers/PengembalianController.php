<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Histori;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{

    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman', 'barang'])->paginate(5 );
        return view('page.pengembalian', compact('pengembalians'));
    }

    public function detail($id)
    {
        $detail = Pengembalian::with(['barang'])->findOrFail($id);
        return view('Subview.detail-pengembalian', compact('detail'));
    }

    public function accPengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = Peminjaman::findOrFail($pengembalian->peminjaman_id);
        $barang = Barang::findOrFail($pengembalian->barang_id);

    Histori::create([
        'kode_barang' => $barang->kode_barang,
        'nama_barang' => $peminjaman->nama_barang,
        'nisn' => $peminjaman->siswa_nisn,
        'status' => 'accepted',
        'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
        'tanggal_kembali' => $peminjaman->tanggal_kembali,
        'tanggal_sebenarnya' => $pengembalian->created_at
    ]);

    if ($pengembalian->bukti_pengembalian && Storage::exists('public/' . $pengembalian->bukti_pengembalian)){
        Storage::delete('public/' . $pengembalian->bukti_pengembalian);
    }

    $barang->status = 'tersedia';
    $barang->save();
    $pengembalian->delete();
    $peminjaman->delete();

    Alert::success('Berhasil', 'Pengembalian berhasil diterima.');
    return redirect()->route('pengembalian.index');
    }


}
