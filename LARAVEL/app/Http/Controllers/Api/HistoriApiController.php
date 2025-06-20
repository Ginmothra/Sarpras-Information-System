<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Histori;
use Illuminate\Http\Request;

class HistoriApiController extends Controller
{
    public function index(Request $request)
    {
        $nisn = $request->user()->nisn;
        $histori = Histori::where('nisn', $nisn)
            ->latest()
            ->get();

        return response()->json($histori);
    }
}
