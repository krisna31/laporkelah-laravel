<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'title' => fake()->realText(random_int(10, 25)),
            'keterangan' => fake()->sentence(random_int(5, 30)),
            'status' => fake()->boolean(),
            'foto' => fake()->word(),
        ];
    }
}
