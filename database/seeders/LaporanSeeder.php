<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan')->insert([
            [
                'id_posyandu' => 1,
                'sasaran_balita_perbulan' => 50,
                'sasaran_ds_perbulan' => 30,
                'sasaran_ibu_hamil' => 15,
                'ibu_hamil_yang_dapat_pelayanan' => 12,
                'sasaran_remaja' => 100,
                'remaja_yang_dapat_pelayanan_kesehatan' => 85,
                'sasaran_usia_produktif' => 200,
                'usia_produktif_yang_dapat_pelayanan_kesehatan' => 180,
                'sasaran_lansia' => 60,
                'lansia_yang_dapat_pelayanan_kesehatan' => 50,
                'jumlah_bayi_yang_di_imunisasi' => 25,
                'jumlah_kunjungan_rumah' => 10,
            ],
            [
                'id_posyandu' => 2,
                'sasaran_balita_perbulan' => 60,
                'sasaran_ds_perbulan' => 40,
                'sasaran_ibu_hamil' => 20,
                'ibu_hamil_yang_dapat_pelayanan' => 18,
                'sasaran_remaja' => 120,
                'remaja_yang_dapat_pelayanan_kesehatan' => 100,
                'sasaran_usia_produktif' => 250,
                'usia_produktif_yang_dapat_pelayanan_kesehatan' => 220,
                'sasaran_lansia' => 70,
                'lansia_yang_dapat_pelayanan_kesehatan' => 60,
                'jumlah_bayi_yang_di_imunisasi' => 30,
                'jumlah_kunjungan_rumah' => 15,
            ],
        ]);
    }
}
