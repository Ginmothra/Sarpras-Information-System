<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PengembalianApiController extends Controller
{
    public function store(Request $request)
{

        if ($request->hasFile('bukti_pengembalian')) {
            $validated['bukti_pengembalian'] = $request->file('bukti_pengembalian')->store('pengembalian', 'public');
        }
    
        Pengembalian::create([
            'kode_barang' => $request['kode_barang'],
            'barang_id' =>$request['barang_id'],
            'peminjaman_id' => $request['peminjaman_id'],
            'tanggal_peminjaman' => $request['tanggal_peminjaman'],
            'tanggal_pengembalian' => $request['tanggal_pengembalian'],
            'nisn' => $request['nisn'],
            'nama_pengembali' => $request['nama_pengembali'],
            'catatan' => $request['catatan'],
            'nama_barang' => $request['nama_barang'],
            'kondisi_barang' => $request['kondisi_barang'],
            'bukti_pengembalian' => $request->file('bukti_pengembalian') ? $validated['bukti_pengembalian'] : null,
        ]);
        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $barang = Barang::findOrFail($request['barang_id']);
        $barang->status = 'pending';
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();
        $barang->save();

        return response()->json(['message' => 'Pengembalian berhasil disimpan']);
     
    }
}

