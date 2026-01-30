<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repository>
 */
class RepositoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(10),
            'thumbnail' => 'images/repojpg.jpg',
            'repo_path' => fake()->randomElement(['paths/index.html', 'paths/index.blade.php', 'paths/index.php', 'paths/styles.css',
             'paths/script.js',]),
            'is_public' => true,
        ];
    }
}
