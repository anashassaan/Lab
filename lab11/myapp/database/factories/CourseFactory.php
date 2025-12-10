<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 day', '+2 months');
        $end = (clone $start)->modify('+'.rand(2, 10).' weeks');

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(3),
            'instructor' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'starts_at' => $start,
            'ends_at' => $end,
        ];
    }
}
