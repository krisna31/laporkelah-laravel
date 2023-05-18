<?php

namespace Database\Factories;

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
            'user_id' => random_int(1,3),
            'company_id' => random_int(1,3),
            'title' => fake()->sentence(),
            'keterangan' => fake()->paragraph(),
            'status' => fake()->boolean(),
            'foto' => fake()->imageUrl(640, 480, 'stuff', true),
        ];
    }
}
