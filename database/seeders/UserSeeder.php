<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'nama' => 'Super Admin',
                'no_hp' => '081234567890',
                'role' => 'super_admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'nama' => 'Murniati',
                'no_hp' => '081234567891',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'nama' => 'Santi Dewi',
                'no_hp' => '0812345678912',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 4,
                'nama' => 'Yeni Marlina',
                'no_hp' => '08123456789123',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 5,
                'nama' => 'Rades Mayana',
                'no_hp' => '081234567891234',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 6,
                'nama' => 'Painam',
                'no_hp' => '0812345678912345',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 7,
                'nama' => 'Nelawarmi',
                'no_hp' => '08123456789123456',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 8,
                'nama' => 'Ngatmi',
                'no_hp' => '081234567891234567',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 9,
                'nama' => 'Dwi Adelia',
                'no_hp' => '0812345678912345678',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 10,
                'nama' => 'Pahmi Susanti',
                'no_hp' => '08123456789123456789',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 11,
                'nama' => 'Noneng Rohaeni',
                'no_hp' => '0812345678912345678901',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 12,
                'nama' => 'Meyda Pangastusi',
                'no_hp' => '081267600405',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 13,
                'nama' => 'Siti Nuraeni',
                'no_hp' => '085278048410',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 14,
                'nama' => 'Fietry Rahmania',
                'no_hp' => '082283866178',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 15,
                'nama' => 'Lorna Wandawati',
                'no_hp' => '082297476357',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 16,
                'nama' => 'Ayunita Mustafa',
                'no_hp' => '082268340989',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
