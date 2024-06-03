<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CatatanPemasukan;
use App\Models\CatatanPengeluaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CatatanPemasukan::factory(10)->create();
        CatatanPengeluaran::factory(10)->create();
        // $this->call(
        //     [
        //         CatatanPemasukanSeeder::class
        //     ]
        // );

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
