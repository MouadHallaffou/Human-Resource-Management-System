<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph, 
            'location' => $this->faker->randomElement(['online', 'offline']), 
            'certificate' => $this->faker->boolean, 
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'), 
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'), 
        ];
    }
}
