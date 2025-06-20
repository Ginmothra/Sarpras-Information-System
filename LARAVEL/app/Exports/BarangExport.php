<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BarangExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $barangs = Barang::with('kategori')->get();
        return view('export.expbarang', compact('barangs'));
    }
}
