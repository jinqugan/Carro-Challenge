<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        // $factory->define(Post::class, function (Faker $faker) {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            // 'author_id' => \App\Models\User::factory(1)->create()->id,,
        ];
        // });

        // $factory->afterCreating(Post::class, function ($post, $faker) {
        //     $post->user_id = factory(User::class)->create()->id;
        //     $post->save();
        // });
    }
}
