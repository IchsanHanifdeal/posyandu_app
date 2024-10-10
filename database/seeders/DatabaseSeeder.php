<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\IdentitasAnak;
use App\Models\Pendamping;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PosyanduSeeder::class,
            PengurusPosyanduSeeder::class,
            IbuSeeder::class,
            PendampingSeeder::class,
            IdentitasAnakSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
