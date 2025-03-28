<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => static::$password ??= Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ];

        return [
            // 'name' => 'mouad hallaffou',
            // 'email' => 'mouadhallaffou@gmail.com',
            // 'password' => static::$password ??= Hash::make('00000000'), 
            // 'image' => 'mouad.jpg',
            // 'phone' => '0678634285',
            // 'birthday' => '2000-11-10', 
            // 'address' => 'res salwa tit mellil casablanca',
            // 'recruitment_date' => '2025-10-10', 
            // 'salary' => '15000', 
            // 'status' => 'actif',
            // 'role_id' => 1, 
            // 'department_id' => 1, 
            // 'contract_id'=> 1, 

            'name' => 'annass',
            'email' => 'annass@gmail.com',
            'password' => static::$password ??= Hash::make('00000000'), 
            'image' => 'mouad.jpg',
            'phone' => '0123055789',
            'birthday' => '2000-11-10', 
            'address' => 'res salwa tit mellil casablanca',
            'recruitment_date' => '2025-10-10', 
            'salary' => '15000', 
            'status' => 'actif',
            'role_id' => 2, 
            'department_id' => 3,
            'contract_id'=> 1, 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
