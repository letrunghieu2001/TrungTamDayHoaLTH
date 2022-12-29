<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(),
            'content' => fake()->paragraph(),
            'created_at' => now(),
            'status' => rand(0, 1),
            'user_id' => User::get('id')->random(1)->first(),
            'category_id' => PostCategory::get('id')->random(1)->first() ,
        ];
    }
}
