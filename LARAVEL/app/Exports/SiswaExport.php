<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $siswa = Siswa::get([
            'nisn',
            'admin',
            'username',
            'created_at',
        ]);
        return view('export.expsiswa', [
            'siswa' => $siswa,
        ]);
    }
}
