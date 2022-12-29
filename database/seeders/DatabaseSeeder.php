<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CreateRoleSeeder::class);
        // $this->call(CreatePostCategorySeeder::class);
        // $this->call(CreateAdminUserSeeder::class);
        // $this->call(CreateUserSeeder::class);
        // $this->call(CreatePostsSeeder::class);
        // $this->call(CreateCommentsSeeder::class);
        $this->call(CreateNewsSeeder::class);
    }
}
