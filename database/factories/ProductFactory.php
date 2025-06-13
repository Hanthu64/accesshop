<?php

namespace Database\Factories;

use App\Enums\CategoryOld;
use App\Models\Category;
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
            'description' => $this -> faker -> words(25, true),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        ];
    }

    public function screen(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Samsung S24A450BW',
            'image' => 'images/Samsung S24A450BW.png',
            'description' => 'Monitor de pantalla ancha, 24 pulgadas, resolución de 1920 x 1080.',
            'category_id' => '2',
        ]);
    }

    public function shoes(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Jordan MVP',
            'image' => 'images/Jordan MVP.png',
            'description' => 'Una zapatilla que hace homenaje a Michael Jordan.',
            'category_id' => '1',
        ]);
    }

    public function console(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Xbox Series S',
            'image' => 'images/Xbox Series S.png',
            'description' => 'Rendimiento de nueva generación en la Xbox más pequeña de la historia.',
            'category_id' => '3',
        ]);
    }

    public function toy(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Nerf 2.0 Commander',
            'image' => 'images/Nerf Commander.png',
            'description' => 'Lanzador de dardos de juguete.',
            'category_id' => '4',
        ]);
    }
}
