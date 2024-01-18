<?php

namespace Database\Factories;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { $food = $this->faker->randomElement(['paste', 'pitza','burger']);
        return [
            'name' => $food,
            'price' =>$this->faker->numberBetween( 15000, 600000),
        ];
    }
}
