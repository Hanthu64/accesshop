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

    public function amazon(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Amazon',
            'homepage' => 'https://www.amazon.es/ref=nav_logo',
            'image' => 'images/amazon.png'
        ]);
    }

    public function backmarket(): Factory
    {
        return $this->state(fn () => [
            'name' => 'BackMarket',
            'homepage' => 'https://www.backmarket.es/es-es',
            'image' => 'images/backmarket.png'
        ]);
    }

    public function pccomponentes(): Factory
    {
        return $this->state(fn () => [
            'name' => 'PcComponentes',
            'homepage' => 'https://www.pccomponentes.com/',
            'image' => 'images/pccomponentes.png'
        ]);
    }

    public function jdsports(): Factory
    {
        return $this->state(fn () => [
            'name' => 'JDSports',
            'homepage' => 'https://www.jdsports.es',
            'image' => 'images/jd.png'
        ]);
    }

    public function footlocker(): Factory
    {
        return $this->state(fn () => [
            'name' => 'FootLocker',
            'homepage' => 'https://www.footlocker.es/es/',
            'image' => 'images/footlocker.png'
        ]);
    }

    public function ebay(): Factory
    {
        return $this->state(fn () => [
            'name' => 'eBay',
            'homepage' => 'https://www.ebay.es/',
            'image' => 'images/ebay.png'
        ]);
    }
}
