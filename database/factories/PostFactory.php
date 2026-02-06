<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class PostFactory extends Factory
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
            'media_path' => fake()->randomElement([
                'images/2.jpg',
                'images/3.jpg',
                'images/4.jpg',
                'images/6.jpg',
            ]),
            'type' => fake()->randomElement(['image']),
            'caption' => fake()->paragraph(10),
        ];
    }
}
