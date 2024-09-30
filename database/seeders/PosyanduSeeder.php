<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posyandu')->insert([
            [
            'nama_posyandu' => 'Posyandu Pucuk Rebung Balai Anak',
            'alamat' => 'Sukamulia',
            'fasilitas' => 'tidak ada'
            ],
            [
            'nama_posyandu' => 'Pucuk Rebung Bersiku Keluang',
            'alamat' => 'Jl. Sukoharjo, RW 5, Kelurahan Sukamulia, Sail, Pekanbaru, Riau',
            'fasilitas' => 'Timbangan, Infant Scale, Pita Ukur Kepala, Alat ukur tinggi balita, Tensi meter, Termometer, Meja Pelayanan, Ruang Konseling, P3K, Tempat Bermain Anak, Toilet, Sabun Cuci Tangan, Tempat Sampah, Kursi'
            ],
        ]);
    }
}
