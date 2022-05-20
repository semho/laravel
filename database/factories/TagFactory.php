<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Webmozart\Assert\Tests\StaticAnalysis\uniqueValues;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
