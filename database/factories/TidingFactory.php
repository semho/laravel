<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TidingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(3, true),
            'description' => $this->faker->text(50),
            'text' => $this->faker->text(100),
            'is_published' => rand(0, 1),
        ];
    }
}
