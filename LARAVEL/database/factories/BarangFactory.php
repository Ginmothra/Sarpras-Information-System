<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    protected $model = Barang::class;
    public function definition(): array
    {
    $barang = [
        'Proyektor',
        'Keyboard',
        'Kabel Roll',
        'Kabel HDMI',
        'Speaker',
        'Tinta',
        'Isi Straples',
        'Kantong Sampah',
        'Kertas A4',
        'Lem',
        'Straples'
];

        return [
            'nama' => fake()->randomElement($barang),
            'stok' => fake()->numberBetween(1, 100),
            'gambar' => 'https://picsum.photos/640/480',
            'kategori' => fake()->randomElement(['habis', 'tetap']),
            'status' => fake()->randomElement(['tersedia', 'terpakai', 'rusak','pending']),
        ];
    }
}
