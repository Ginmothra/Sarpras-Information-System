<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')
        ->where('kondisi', 'baik')
        ->where('status','tersedia')
        ->get();
       
        return response()->json([
            'status' => true,
            'data' => $barangs
        ]);
    }
}
