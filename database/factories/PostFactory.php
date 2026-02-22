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
            'media_path' => 'posts/images/' . fake()->randomElement(['2.jpg', '3.jpg', '4.jpg', '6.jpg']), 
            'type' => 'image', 
            'caption' => fake()->paragraph(2), 
        ];
    }
}
