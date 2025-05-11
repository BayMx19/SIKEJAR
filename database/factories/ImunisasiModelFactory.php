<?php

namespace Database\Factories;

use App\Models\AnakModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImunisasiModel>
 */
class ImunisasiModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anak_id' => AnakModel::factory(),
            'tanggal_imunisasi' => $this->faker->date(),
            'jenis_imunisasi' => $this->faker->randomElement(['BCG-Polio 1', 'DPT-HB-Hib 1, Polio 2', 'DPT-HB-Hib 2, Polio 3', 'DPT-HB-Hib 3, Polio 4, IPV', 'Campak / Measles Rubella (MR)']),
            'keterangan' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Belum', 'Sudah', 'Tertinggal']),
        ];
    }
}
