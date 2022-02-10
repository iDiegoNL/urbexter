<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\ISO3166\ISO3166;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $countries = (new ISO3166())->all();

        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentences(5, true),
            'country' => $countries[array_rand($countries)]['alpha2'],
            'build_year' => $this->faker->year,
            'abandoned_year' => $this->faker->year,
            'demolished_year' => $this->faker->year,
            'reconverted_year' => $this->faker->year,
        ];
    }
}
