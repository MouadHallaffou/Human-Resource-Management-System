<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'typeContract' => $this->faker->randomElement(['CDI', 'CDD', 'Freelance', 'Stage']),
            'document' => $this->faker->optional()->word, 
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
        ];
    }
}
