<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nama" => 'Admin',
            "username" => 'admin',
            "email" => 'admin@gmail.com',
            "email_verified_at" => now(),
            "password" => Hash::make('adminadmin'),
            "role" => 'admin',
            "no_hp" => 'no_hp',
            "alamat" => 'alamat',
        ]);

        User::create([
            "nama" => 'nasabah',
            "username" => 'nasabah',
            "email" => 'nasabah@gmail.com',
            "email_verified_at" => now(),
            "password" => Hash::make('password'),
            "role" => 'nasabah',
            "no_hp" => 'no_hp',
            "alamat" => 'alamat',
        ]);
    }
}
