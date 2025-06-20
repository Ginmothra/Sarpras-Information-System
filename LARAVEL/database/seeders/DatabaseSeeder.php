<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Database\Seeders\BarangSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    $this->call([
    //         BarangSeeder::class,
    //     ]);

        Admin::create([
            'name' => 'rafli',
            'password' => bcrypt('123'),]);
    }
}
