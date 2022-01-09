<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $users = factory(User::class, 10)->create()->each(function ($user) {
            $user->posts()->saveMany(factory(Post::class)->make());
        });
//        $user = \App\Models\User::factory()->count(10)->create()
//            ->each(function ($user) {
////                var_dump($user);
//                $user->posts()->save(factory(\App\Models\Post::class, 10)->make());
//            });
//

    }
}
