<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();
        $total_denda = $user->denda()
            ->where('status','belum_lunas')
            ->sum('jumlah');

        return response()->json([
            'nama' => $user->username,
            'nisn' => $user->nisn,
            'tanggal_bergabung' => $user->created_at->toDateString(),
            'total_denda' => $total_denda,
        ]);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Berhasil logout']);
    }
}
