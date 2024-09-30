<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendampingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendamping')->insert([
            [
                'id_ibu' => '1',
                'nama' => 'Salmon',
            ],
            [
                'id_ibu' => '2',
                'nama' => 'M. Yusuf',
            ],
            [
                'id_ibu' => '3',
                'nama' => 'Angga Romadhon',
            ],
            [
                'id_ibu' => '4',
                'nama' => 'Agus Suwardi',
            ],
        ]);
    }
}
