<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "username" => "Suxan",
            'email' => "suxanoff17@gmail.com",
            'password' => "password",
            'profile_image' => 'users/profile_photo/default.jpg',
        ]);
        User::create([
            "username" => "Han",
            'email' => "handurdy@gmail.com",
            'password' => "password",
            'profile_image' => 'users/profile_photo/default.jpg',
        ]);
        User::create([
            "username" => "Maisa",
            'email' => "maisaShad@gmail.com",
            'password' => "password",
            'profile_image' => 'users/profile_photo/default.jpg',
        ]);
    }
}
