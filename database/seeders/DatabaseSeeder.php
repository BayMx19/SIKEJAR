<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                AnakSeeder::class,
                ImunisasiSeeder::class,
                JadwalImunisasiSeeder::class,
                UsersSeeder::class,
                FeedbackSeeder::class,
            ]
        );
    }
}
