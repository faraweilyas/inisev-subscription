<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $title = $this->faker->text(30);
        return [
            'website_id' => rand(1, 5),
            'user_id' => rand(1, 5),
            'slug' => Str::slug($title),
            'title' => $title,
            'description' => $this->faker->text(),
        ];
    }
}
