<?php

namespace Database\Factories;

use App\Models\AnakModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnakModelFactory extends Factory
{
    protected $model = AnakModel::class;

    public function definition()
    {
        return [
            'users_id' => \App\Models\UsersModel::factory(),
            'nama_anak' => $this->faker->name,
            'NIK_anak' => $this->faker->numerify('############0001'),
            'tanggal_lahir_anak' => $this->faker->date('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'status' => $this->faker->randomElement(['Hidup', 'Meninggal']),

        ];
    }
}
