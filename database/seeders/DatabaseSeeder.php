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

        $user = User::factory()->count(30)
            ->has(Post::factory()->count(3), 'posts')
            ->create();

//       $users = factory(User::class, 10)->create()->each(function ($user) {
//            $user->posts()->saveMany(factory(Post::class)->make());
//        });
//          User::factory()->count(3)->create()
//            ->each(function ($user) {
////                var_dump($user);
//                $user->posts->save(factory(Post::class, 10)->make());
//            });


    }
}
