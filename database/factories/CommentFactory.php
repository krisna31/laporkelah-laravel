<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_id' => Report::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'isi' => fake()->sentence(random_int(8, 30)),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
