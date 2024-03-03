<?php

namespace Database\Seeders;

use App\Models\CatatanPemasukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Number;

class CatatanPemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CatatanPemasukan::create([
            'gambar' => Hash::make('gambar'),
            'judul' => Str::random(20),
            'deskripsi' => Str::random(10),
            'uang_masuk' => random_int(100000, 1000000),
            'sumber_uang_masuk' => 'Orang Tua',
            'kategori_uang_masuk' => 'Cash',
            'total_uang_masuk' => 1000000,
        ]);
    }
}
