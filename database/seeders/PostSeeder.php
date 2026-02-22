<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            "user_id" => 1,
            'media_path' => "posts/images/my6.jpg",
            'type' => "image",
            'caption' => 'Coding Time 03:15 AM  #CodingTime #VsCode #FullStack #rek',
        ]);
        Post::create([
            "user_id" => 1,
            'media_path' => "posts/images/my1.jpg",
            'type' => "image",
            'caption' => 'IŞM Galkan sport merkezi #GymTime #Wresling #fyp',
        ]);
        Post::create([
            "user_id" => 1,
            'media_path' => "posts/images/my2.jpg",
            'type' => "image",
            'caption' => 'Football time #FootballTime #fyp',
        ]);
        Post::create([
            "user_id" => 1,
            'media_path' => "posts/images/my3.png",
            'type' => "image",
            'caption' => 'MY bro @bego_xxs #GujurlyTeckFestival #fyp #Gujurly',
        ]);
        Post::create([
            "user_id" => 1,
            'media_path' => "posts/videos/my4Vi.mp4",
            'type' => "video",
            'caption' => 'Last day... #Gym #Wresling #forYouPage #LastDay',
        ]);
    }
}
