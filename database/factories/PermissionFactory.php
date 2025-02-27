<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['create employe', 'edit employe', 'delete employe', 'view employe',
            'create département', 'edit département', 'delete département', 'view département',
            'create contrats', 'edit contrats', 'delete contrats', 'view contrats',
            'approve leave', 'reject leave', 'manage payroll', 'generate reports'
            ]),
            'guard_name' => 'web',
        ];
    }
}
