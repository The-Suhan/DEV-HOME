<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Repository;
class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Repository::create([
            "user_id" => 1,
            'title' => "instagram clone",
            'description' => "Help with you",
            'thumbnail' => 'images/repojpg.jpg',
            'repo_path' => 'paths/styles.css',
        ]);
        Repository::create([
            "user_id" => 2,
            'title' => "tik tok clone",
            'description' => "Help with you",
            'thumbnail' => 'images/repojpg.jpg',
            'repo_path' => 'paths/index.blade.php',
        ]);
        Repository::create([
            "user_id" => 3,
            'title' => "instagram front-end",
            'description' => "Help with you",
            'thumbnail' => 'images/repojpg.jpg',
            'repo_path' => 'paths/index.html',
        ]);
    }
}
