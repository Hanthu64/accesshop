<?php

namespace Database\Factories;

use App\Enums\Category;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'image' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/150/150',
            'description' => $this -> faker -> words(10, true),
            'view_description' => $this -> faker -> words(25, true),
            'category' => $this -> faker -> randomElement(Category::cases())
        ];
    }
}
