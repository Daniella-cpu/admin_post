<?php

namespace Database\Factories;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'user_id' => factory(User::class),
//            'user_id' => mt_rand(1, 3),
            'title' => $this->faker->text(25),
            'post_image' => $this->faker->imageUrl('900', '300'),
            'body' => $this->faker->paragraph()
            //
        ];
    }
}
