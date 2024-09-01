<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengurusPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengurus_posyandu')->insert([ 
            [
            'id_posyandu' => '1',
            'id_user' => '2',
            ],
            [
            'id_posyandu' => '1',
            'id_user' => '3',
            ],
            [
            'id_posyandu' => '1',
            'id_user' => '4',
            ],
            [
            'id_posyandu' => '1',
            'id_user' => '5',
            ],
            [
            'id_posyandu' => '1',
            'id_user' => '6',
            ],
            [
            'id_posyandu' => '2',
            'id_user' => '7',
            ],
            [
            'id_posyandu' => '2',
            'id_user' => '8',
            ],
            [
            'id_posyandu' => '2',
            'id_user' => '9',
            ],
            [
            'id_posyandu' => '2',
            'id_user' => '10',
            ],
            [
            'id_posyandu' => '2',
            'id_user' => '11',
            ],
        ]);
    }
}
