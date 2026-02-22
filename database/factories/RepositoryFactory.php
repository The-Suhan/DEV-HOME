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
            'user_id' => \App\Models\User::all()->random()->id,
            'repo_path' => 'repos/repo_paths/' . fake()->randomElement(['index.zip', 'script.zip', 'styles.zip']),
            'thumbnail' => 'repos/repo_thumbnail/repojpg.jpg',
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(10),
            'is_public' => true,
        ];
    }
}
