<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::paginate(5);
        return view('page.data-kategori', compact('kategoris'));
    }
    
    public function store(Request $request){
        $nama_kategori = $request->nama_kategori;
        if (Kategori::where('nama_kategori', $nama_kategori)->exists()){
            Alert::error('Error', 'Nama Kategori Sudah Ada');
            return redirect()->back();
        };
        $admin = Auth::user()->name;
        DB::statement('CALL tambah_kategori(?,?)',[$nama_kategori,$admin]);
        Alert::success('Berhasil','Berhasil Menambahkan Kategori');
        return redirect(route('kategori.index'));
    }
    public function update(Request $request, $id){
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        Alert::success('Berhasil', 'Berhasil Mengedit Kategori');
        return redirect()->route('kategori.index');

    }
    public function destroy($id)
    {
        DB::statement('CALL hapus_Kategori(?)', [$id]);
        Alert::success('Berhasil', 'Data barang berhasil dihapus');
        return redirect()->route('kategori.index',$id)->with('success');
    }
}
