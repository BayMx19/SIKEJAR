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
            'password' => Hash::make('Ibu123'),
            'role' => "User",
            'status' => "ACTIVE",
        ]);

    }
}