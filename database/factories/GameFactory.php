<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $f          = fake()->streetSuffix;
        $l          = fake()->city;

        return [
            'title'         => $f . ' ' . $l,
            // 'img'           => fake()->imageUrl($width = 640, $height = 480),
            'date_release'  => fake()->date($format = 'Y-m-d'),
            'developer'     => fake()->company ,
            'synopsis'      => fake()->realText($maxNbChars = 50, $indexSize = 2),
        ];
    }
}
