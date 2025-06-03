<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'nama' => "SuperAdmin",
            'password' => Hash::make('SuperAdmin123'),
            'role' => "SuperAdmin",
            'status' => "ACTIVE",
        ]);
        DB::table('users')->insert([
            'username' => "dokter1",
            'email' => "dokter@gmail.com",
            'nama' => "dokter1",
            'password' => Hash::make('dokter123'),
            'role' => "Dokter",
            'status' => "ACTIVE",
        ]);
        DB::table('users')->insert([
            'username' => "kader1",
            'email' => "kader@gmail.com",
            'nama' => "kader1",
            'password' => Hash::make('Kader123'),
            'role' => "Kader",
            'status' => "ACTIVE",
        ]);
        DB::table('users')->insert([
            'username' => "ibu1",
            'email' => "ibu@gmail.com",
            'nama' => "ibu1",
            'NIK' => "1234567891234567",
            'nomor_telepon' => "081234567890",
            'alamat' => "Tepus",
            'RT' => "05",
            'RW' => "15",
            'password' => Hash::make('Ibu123'),
            'role' => "User",
            'status' => "ACTIVE",
        ]);

    }
}
