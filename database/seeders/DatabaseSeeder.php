<?php

namespace Database\Seeders;

use App\Enums\Role;
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
        Product::factory(10)->create();
        Shop::factory(10)->create();
        User::factory(10)->create()->each(function ($user) {
            if ($user->role === Role::Provider) {
                // Asignar una tienda aleatoria
                $user->shop_id = Shop::inRandomOrder()->first()->id;
            }
            $user->save();
        });

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
