<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'director' => fake()->name(),
            'genre' => fake()->randomElement([
                'Drama',
                'Komedi',
                'Aksi',
                'Horor',
                'Animasi',
                'Romansa',
            ]),
            'release_year' => fake()->numberBetween(2000, 2026),
            'duration' => fake()->numberBetween(80, 180),
            'synopsis' => fake()->paragraph(),
        ];
    }
}
