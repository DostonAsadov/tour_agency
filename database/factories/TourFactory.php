<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'               => $this->faker->sentence(3),
            'description'        => $this->faker->paragraph(),
            'price'              => $this->faker->randomFloat(2, 100, 5000),
            'duration'           => $this->faker->numberBetween(1, 30),
            'capacity_of_people' => $this->faker->numberBetween(5, 50),
            'season'             => $this->faker->randomElement(['Spring', 'Summer', 'Autumn', 'Winter']),
            'image'              => null,
        ];
    }
}
