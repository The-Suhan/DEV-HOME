<?php

namespace Database\Seeders;

use App\Models\User;                                                     
use App\Models\Admin;
use App\Models\Repository;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            RepositorySeeder::class,
        ]);

      User::factory(10)->create();
      Admin::factory(1)->create();
      Repository::factory(10)->create();
    }
}
