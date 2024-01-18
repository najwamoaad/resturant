<?php

namespace Database\Factories;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cuisine' => $this->faker->randomElement(['Italian', 'Mexican', 'Chinese', 'Indian']),
            'rating' => $this->faker->numberBetween(1, 5),
            'address' => $this->faker->address(),
            'contact' => $this->faker->phoneNumber(),
        ];
    }
}
