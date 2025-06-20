<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanApiController extends Controller
{
    public function index(Request $request)
    {
        $nisn = $request->user()->nisn;
        $peminjamans = Peminjaman::with('barang')
        ->where('siswa_nisn', $nisn)
        ->orderByDesc('id')
        ->get();
        return response()->json([
            'message' => 'Data peminjaman',
            'data' => $peminjamans
        ]);
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'kode_barang' => 'required',
            'siswa_nisn' => 'required|exists:siswa,nisn',
            'nama_barang' => 'required|exists:barang,nama',
            'barang_id' => 'required|exists:barang,id',
            'alasan' => 'required|string',
            'status' => 'pending',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ],[
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal pinjam.',
        ]);

    $peminjaman = Peminjaman::create($validated);
    $barang = Barang::findOrFail($validated['barang_id']);
    if ($barang){
        $barang->status = 'pending';
        $barang->save();
    }
   

    return response()->json([
        'message' => 'Peminjaman berhasil dikirim',
        'data' => $peminjaman
    ], 201);
}
}
