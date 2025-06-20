<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function form()
    {
        $kategoris = Kategori::all();
        return view('barang.tambah-barang', compact('kategoris'));
    }
    public function create()
    {
        $validate = request()->validate([
            'nama' => 'required',
            'kode_barang' => 'required|string', 
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    
        ]);
        $kode_barang = request('kode_barang');
        $exist = Barang::where('kode_barang',$kode_barang)->exists();
        if($exist){
             Alert::error('Error','Kode barang sudah digunakan');
             return redirect()->back()->withInput();
        }

        $path_gambar = request()->file('gambar')->store('gambar', 'public');
        
        Barang::create([
            'kode_barang' => $validate['kode_barang'],
            'nama' => $validate['nama'],
            'admin' => Auth::user()->name,
            'gambar' => $path_gambar,
            'kategori_id' => request()->kategori_id,
            'status' => 'tersedia',
        ]);
        Alert::success('Berhasil', 'Data barang berhasil ditambahkan'); 
        return redirect()->route('index.barang')->with('success');
    }
    public function index()
    {       
        $filter = '';
        $kategoris = Kategori::all();
        $barangs = Barang::with('kategori')
        ->where('kondisi', '=', 'baik')->paginate(5);
        return view('Page.data-barang', compact('barangs','filter','kategoris'));
    }
    public function search(Request $request)
    {
        $filter = '';
        $search = $request->input('search');
        $kategoris = Kategori::all();
        $barangs = Barang::where('nama', 'like', "%$search%")->paginate(5)->appends('search', $search);
        return view('Page.data-barang', compact('barangs', 'search', 'filter','kategoris'));
    }
    public function filter(Request $request)
    {   
        $filter = $request->input('filter','');
        $kategoris = Kategori::all();

        $barangs = Barang::where('kategori_id', 'like', "%$filter%")->paginate(5)->appends(['filter'=> $filter]);
        return view('Page.data-barang', compact('barangs', 'filter', 'kategoris'));
    }
    public function edit($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('barang.edit-barang',compact('barang','kategoris'));
    }

   public function update(Request $request, $id)
{

    $barang = Barang::findOrFail($id);

    if ($request->hasFile('gambar')) {
         if ($barang->gambar && Storage::exists('public/' . $barang->gambar)) {
        Storage::delete('public/' . $barang->gambar);
    }
        $gambarPath = $request->file('gambar')->store('gambar', 'public');
        $barang->gambar = $gambarPath;
    }


    $barang->kode_barang = $request->kode_barang;
    $barang->nama = $request->nama;
    $barang->kategori_id = $request->kategori_id;
    

    $barang->save();

    Alert::success('Berhasil', 'Data barang berhasil diupdate');
    return redirect()->route('index.barang')->with('success');
}

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->gambar && Storage::exists('public/' . $barang->gambar)){
            Storage::delete('public/' . $barang->gambar);
        }
        $barang->delete();
        Alert::success('Berhasil', 'Data barang berhasil dihapus');
        return redirect()->route('index.barang')->with('success');
    }
    public function export()
    {
        return Excel::download(new BarangExport,'Barang.xlsx');
    }
}
