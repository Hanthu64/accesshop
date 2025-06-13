<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $faker;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $nombres = ['Ropa', 'Electrodomésticos', 'Consolas', 'Juguetes'];

        foreach ($nombres as $nombre) {
            Category::factory()->create(['name' => $nombre]);
        }

        Product::factory()->screen()->create();
        Product::factory()->shoes()->create();
        Product::factory()->console()->create();
        Product::factory()->toy()->create();

        Shop::factory(10)->create();

        User::factory()->admin()->create();
        User::factory()->provider()->create();
        User::factory()->user()->create();

        foreach (Shop::all() as $shop) {
            $products = Product::inRandomOrder()->limit(3)->pluck('id')->toArray();
            foreach ($products as $product) {
                $shop->product()->attach($product, [
                    'rating' => rand(1, 5),
                    'price' => fake() -> randomFloat(2, 1, 500),
                    'product_link' => fake()->url,
                ]);
            }
        }


    }
}
