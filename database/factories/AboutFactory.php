<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_name'    => $this->faker->company(),
            'email'           => $this->faker->companyEmail(),
            'phone'           => $this->faker->phoneNumber(),
            'phone2'          => $this->faker->phoneNumber(),
            'address'         => $this->faker->address(),
            'working_hours'   => ['Mon-Fri: 9:00-18:00', 'Sat: 10:00-15:00'],
            'facebook_link'   => 'https://facebook.com/example',
            'instagram_link'  => 'https://instagram.com/example',
            'youtube_link'    => 'https://youtube.com/example',
            'travelers'       => $this->faker->numberBetween(100, 10000),
            'hotels'          => $this->faker->numberBetween(10, 500),
            'completed_tours' => $this->faker->numberBetween(50, 1000),
            'experience_years'=> $this->faker->numberBetween(1, 30),
            'number_partners' => $this->faker->numberBetween(5, 100),
        ];
    }
}
