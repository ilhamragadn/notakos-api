<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CatatanPemasukan>
 */
class CatatanPemasukanFactory extends Factory
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
            'uang_masuk' => $this->faker->numberBetween(100000, 1000000),
            'sumber_uang_masuk' => $this->faker->randomElement(['Orang Tua', 'Gaji', 'Hasil Usaha']),
            'kategori_uang_masuk' => $this->faker->randomElement(['Cash', 'Cashless']),
            'total_uang_masuk' => $this->faker->numberBetween(500000, 2000000),
        ];
    }
}
