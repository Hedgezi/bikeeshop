<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
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
            'price' => $this->faker->randomFloat(3, 1, 80000),
            'quantity' => $this->faker->randomNumber(2)
        ];
    }
}
