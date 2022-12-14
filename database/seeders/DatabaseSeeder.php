<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use App\Models\Subscribers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Website::factory(5)->create();
        Post::factory(15)->create();
        Subscribers::factory(10)->create();
    }
}
