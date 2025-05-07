<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this -> faker -> words(2, true),
            'homepage' => $this -> faker -> url(),
            'image' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/150/150',
        ];
    }
}
