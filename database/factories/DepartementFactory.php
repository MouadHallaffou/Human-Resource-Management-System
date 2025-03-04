<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departement>
 */
class DepartementFactory extends Factory
{
    protected $model = Departement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'company_id' => Company::factory(),
            'responsable_id' => User::factory(),
        ];
    }
}
