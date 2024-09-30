<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IbuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ibu')->insert([
            [
                'id_posyandu' => '2',
                'id_user' => '12',
                'nik' => '3674024605990001',
                'no_jkn' => '-',
                'faskes_tk_1' => '-',
                'faskes_rujukan' => '-',
                'pembiayaan' => '-',
                'golongan_darah' => '-',
                'tempat_lahir' => '-',
                // 'tanggal_lahir' => '-',
                'pendidikan' => '-',
                'pekerjaan' => '-',
                'alamat' => 'Jl. Sukoharjo RT 01, RW 05',
                'puskesmas_domisili' => 'Pucuk Rebung Bersiku Keluang',
                'no_register_kohort' => '-',
            ],
            [
                'id_posyandu' => '2',
                'id_user' => '13',
                'nik' => '2171026007910004',
                'no_jkn' => '-',
                'faskes_tk_1' => '-',
                'faskes_rujukan' => '-',
                'pembiayaan' => '-',
                'golongan_darah' => '-',
                'tempat_lahir' => '-',
                // 'tanggal_lahir' => '-',
                'pendidikan' => '-',
                'pekerjaan' => '-',
                'alamat' => 'Jl. Sukoharjo RT 02, RW 05',
                'puskesmas_domisili' => 'Pucuk Rebung Bersiku Keluang',
                'no_register_kohort' => '-',
            ],
            [
                'id_posyandu' => '2',
                'id_user' => '14',
                'nik' => '1471037008910001',
                'no_jkn' => '-',
                'faskes_tk_1' => '-',
                'faskes_rujukan' => '-',
                'pembiayaan' => '-',
                'golongan_darah' => '-',
                'tempat_lahir' => '-',
                // 'tanggal_lahir' => '-',
                'pendidikan' => '-',
                'pekerjaan' => '-',
                'alamat' => 'Jl. Sukoharjo No 53 RT 02, RW 05',
                'puskesmas_domisili' => 'Pucuk Rebung Bersiku Keluang',
                'no_register_kohort' => '-',
            ],
            [
                'id_posyandu' => '2',
                'id_user' => '15',
                'nik' => '1408045807990001',
                'no_jkn' => '-',
                'faskes_tk_1' => '-',
                'faskes_rujukan' => '-',
                'pembiayaan' => '-',
                'golongan_darah' => '-',
                'tempat_lahir' => '-',
                // 'tanggal_lahir' => '-',
                'pendidikan' => '-',
                'pekerjaan' => '-',
                'alamat' => 'Jl. Sukoharjo No 53 RT 02, RW 05',
                'puskesmas_domisili' => 'Pucuk Rebung Bersiku Keluang',
                'no_register_kohort' => '-',
            ],
            [
                'id_posyandu' => '2',
                'id_user' => '16',
                'nik' => '1471034706940001',
                'no_jkn' => '-',
                'faskes_tk_1' => '-',
                'faskes_rujukan' => '-',
                'pembiayaan' => '-',
                'golongan_darah' => '-',
                'tempat_lahir' => '-',
                // 'tanggal_lahir' => '-',
                'pendidikan' => '-',
                'pekerjaan' => '-',
                'alamat' => 'Jl. Sukoharjo No 53 RT 02, RW 05',
                'puskesmas_domisili' => 'Pucuk Rebung Bersiku Keluang',
                'no_register_kohort' => '-',
            ],
        ]);
    }
}
