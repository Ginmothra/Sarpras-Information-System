<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Siswa;
use App\Models\Barang;
use App\Models\Histori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DendaController extends Controller
{
   public function index()
    {
        $dendas = Siswa::withSum(['denda as total_denda' => function ($query) {
                $query->where('status', 'belum_lunas');
            }], 'jumlah')
            ->paginate(5);

        return view('page.data-denda', compact('dendas'));
    }

    public function form($nisn, Request $request)
    { 
        $from = $request->query('from');

        if ($from === 'pengembalian'){
            $data = Pengembalian::where('nisn', $nisn )->first(['nama_pengembali', 'nisn']);
            $nama = $data->nama_pengembali;
            return view('subview.form-denda',compact('nama', 'nisn', 'from'));
        }elseif ($from === 'denda') {
            $data = Siswa::where('nisn', $nisn)->first(['username']);
            $nama = $data->username;
            return view('subview.form-denda',compact('nama', 'nisn', 'from'));
        }
    }
    public function detail($nisn)
    {
        $dendas = Denda::where('siswa_nisn', '=', $nisn)->get();
        return view('subview.detail-denda', compact('dendas'));
    }
   public function insert(Request $request)
    {
        $from = $request->from;

        if ($from === 'pengembalian')
        {
            $request->validate([
                'nisn' => 'required|string',
                'jumlah' => 'required|integer',
                'keterangan' => 'nullable|string|max:255',
            ]);
            
            $nisn = $request->nisn;
            $pengembalian = Pengembalian::where('nisn', $nisn)->firstOrFail();
            $peminjaman = Peminjaman::findOrFail($pengembalian->peminjaman_id);
            $barang = Barang::findOrFail($pengembalian->barang_id);
            
            Denda::create([
                'siswa_nisn' => $request->nisn,
                'jumlah' => $request->jumlah,
                'status' => 'belum_lunas',
                'keterangan' => $request->keterangan,
                'admin' => Auth::user()->name,
            ]); 

            Histori::create([
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $peminjaman->nama_barang,
                'nisn' => $peminjaman->siswa_nisn,
                'status' => 'accepted',
                'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
                'tanggal_kembali' => $peminjaman->tanggal_kembali,
                'tanggal_sebenarnya' => $pengembalian->created_at,
            ]);
            $barang->status = 'tersedia';
            $barang->save();
    
            $pengembalian->delete();
            $peminjaman->delete();
        }elseif ($from === 'denda')
        {
            $request->validate([
                'nisn' => 'required|string',
                'jumlah' => 'required|integer',
                'keterangan' => 'nullable|string|max:255',
            ]);
    
            Denda::create([
                'siswa_nisn' => $request->nisn,
                'jumlah' => $request->jumlah,
                'status' => 'belum_lunas',
                'keterangan' => $request->keterangan,
                'admin' => Auth::user()->name,
            ]);
        }




        Alert::success('Berhasil', 'Denda berhasil ditambahkan.');

        return redirect()->route('index.denda');
    
    }
    public function acc($id)
    {
        $denda = Denda::findOrFail($id);
        $denda->status = 'lunas';
        $denda->save();

        Alert::success('Berhasil', 'Denda berhasil dilunasi.');

        return redirect()->route('index.denda');
    }


}

