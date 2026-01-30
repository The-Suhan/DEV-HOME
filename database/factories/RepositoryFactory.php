<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => fake()->numberBetween(4,10),
            'title' => fake()->randomElement(['instagram clone','tik tok clone','you tube clone','form page html css js','dashboard frontend','E-comercy full']),
            'description' =>  fake()->sentence(),
            'thumbnail' => 'images/repojpg.jpg',
            'repo_path' =>fake()->randomElement(['paths/index.html','paths/index.blade.php','paths/index.php','paths/styles.css','paths/script.js',]),
        ];
    }
}
