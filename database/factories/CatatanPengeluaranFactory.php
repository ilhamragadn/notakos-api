<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CatatanPengeluaran>
 */
class CatatanPengeluaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gambar' => Hash::make('gambar'),
            'judul' => Str::random(20),
            'deskripsi' => Str::random(10),
            'nama_barang' => Str::random(10),
            'jenis_pengeluaran' => Str::random(10),
            'harga_barang' => $this->faker->numberBetween(10000, 100000),
            'satuan_barang' => $this->faker->numberBetween(1, 10),
            'uang_keluar' => $this->faker->numberBetween(100000, 1000000),
            'sumber_uang_keluar' => $this->faker->randomElement(['Orang Tua', 'Gaji', 'Hasil Usaha']),
            'kategori_uang_keluar' => $this->faker->randomElement(['Cash', 'Cashless']),
            'total_uang_keluar' => $this->faker->numberBetween(1000000, 2000000),
        ];
    }
}
