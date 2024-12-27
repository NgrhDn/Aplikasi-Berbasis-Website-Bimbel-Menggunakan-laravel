<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role_id' => 1, // Admin
                'kelas' => null, // Admin tidak memiliki kelas
            ],
            [
                'name' => 'Pengajar 1',
                'email' => 'pengajar1@gmail.com',
                'password' => Hash::make('pengajar1'),
                'role_id' => 2, // Pengajar
                'kelas' => null, // Pengajar tidak memiliki kelas
            ],
            [
                'name' => 'Siswa Kelas 10',
                'email' => 'siswa10@gmail.com',
                'password' => Hash::make('siswa10'),
                'role_id' => 3, // Siswa
                'kelas' => 10, // Kelas 10
            ],
            [
                'name' => 'Siswa Kelas 11',
                'email' => 'siswa11@gmail.com',
                'password' => Hash::make('siswa11'),
                'role_id' => 3, // Siswa
                'kelas' => 11, // Kelas 11
            ],
            [
                'name' => 'Siswa Kelas 12',
                'email' => 'siswa12@gmail.com',
                'password' => Hash::make('siswa12'),
                'role_id' => 3, // Siswa
                'kelas' => 12, // Kelas 12
            ],
        ]);
    }
}
