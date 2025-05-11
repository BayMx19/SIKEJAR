<?php

namespace Database\Factories;

use App\Models\UsersModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersModelFactory extends Factory
{
    protected $model = UsersModel::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'),
            'nama' => $this->faker->name,
            'NIK' => $this->faker->numerify('##########'),
            'nomor_telepon' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'RT' => $this->faker->numberBetween(1, 10),
            'RW' => $this->faker->numberBetween(1, 10),
            'role' => 'User',
            'status' => 'Active',
        ];
    }
}
