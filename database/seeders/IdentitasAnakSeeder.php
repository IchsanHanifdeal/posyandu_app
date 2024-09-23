<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdentitasAnakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('identitas_anak')->insert([
            [
                'id_ibu' => '2',
                'nama' => 'Hana Sabrina',
                'berat' => '2.6',
                'panjang' => '46',
                'jenis_kelamin' => 'perempuan',
                'tanggal' => '2023-05-30',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_ibu' => '3',
                'nama' => 'Rafka Virendra Agafi',
                'berat' => '3.5',
                'panjang' => '52',
                'jenis_kelamin' => 'perempuan',
                'tanggal' => '2023-06-06',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_ibu' => '1',
                'nama' => 'Elshahanum Dwi Rizkiana',
                'berat' => '3.4',
                'panjang' => '50',
                'jenis_kelamin' => 'perempuan',
                'tanggal' => '2023-04-14',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_ibu' => '4',
                'nama' => 'M. Aelamda Ayatullah',
                'berat' => '2.9',
                'panjang' => '49',
                'jenis_kelamin' => 'laki-laki',
                'tanggal' => '2023-10-04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_ibu' => '5',
                'nama' => 'Zaheera',
                'berat' => '2.8',
                'panjang' => '48',
                'jenis_kelamin' => 'perempuan',
                'tanggal' => '2023-09-19',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
