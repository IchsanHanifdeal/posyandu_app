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
            'alamat' => 'Sukamulia',
            'fasilitas' => 'tidak ada'
            ],
        ]);
    }
}
