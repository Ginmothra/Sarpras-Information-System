<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

use Laravel\Sanctum\PersonalAccessToken;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::paginate(10);
        return view('Page.data-siswa', compact('siswas'));
    }

     public function search(Request $request)
    {
        $search = $request->input('search');
        $siswas = Siswa::where('nama', 'like', "%$search%")->paginate(10)->appends('search', $search);
        return view('Page.data-barang', compact('siswas', 'search'));
    }
    
    public function register(Request $request)
    {
        $siswa = new Siswa;
        
        $siswa->nisn = $request->nisn;
        $siswa->admin = Auth::user()->name;
        $siswa->username = $request->username;
        $siswa->password = 'smktb123';
        
        $siswa->save();
        Alert::success('Berhasil', 'Siswa berhasil terdaftar');
        return redirect()->route('siswa.index');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        Alert::success('Berhasil', 'Siswa berhasil dihapus');
        return redirect()->back();
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('Subview.edit-siswa', compact('siswa'));
    }
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $siswa->nisn = $request->nisn;
        $siswa->username = $request->username;
        
        if ($request->filled('password')) {
            $siswa->password = $request->password;
        }
        
        $siswa->save();
        Alert::success('Berhasil', 'Siswa berhasil diperbarui');
        return redirect()->route('siswa.index');
    }

    public function login(Request $request)
{
    $nisn = $request->input('nisn');
    $password = $request->input('password');

    $siswa = Siswa::where('nisn', $nisn)->first();

    if ($siswa && Hash::check($password, $siswa->password)) {
        $token = $siswa->createToken('siswa-login-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'nisn' => $siswa->nisn,
            'nama' => $siswa->username,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'NISN atau password salah',
    ], 401);
}


public function logout(Request $request)
{
    $token = $request->bearerToken();
    $accessToken = PersonalAccessToken::findToken($token);

    if ($accessToken) {
        $accessToken->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }

    return response()->json(['message' => 'Token tidak ditemukan atau sudah logout'], 401);
}

public function export(){
    return Excel::download(new SiswaExport, 'siswa.xlsx');
}

}
