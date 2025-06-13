<?php

namespace Database\Factories;

use App\Enums\CategoryOld;
use App\Enums\Role;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this -> faker -> name,
            'image' => 'images/usericon.png',
            'email' => $this -> faker -> unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('14735848'),
            'role' => $this->faker->randomElement(Role::cases()),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Admin',
            'image' => 'images/usericon.png',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => 'Admin',
            'role' => Role::Admin,
            'remember_token' => Str::random(10),
        ]);
    }

    public function provider(): Factory
    {
        return $this->state(fn () => [
            'name' => 'Provider',
            'image' => 'images/usericon.png',
            'email' => 'provider@example.com',
            'email_verified_at' => now(),
            'password' => 'Provider',
            'role' => Role::Provider,
            'shop_id' => 1,
            'remember_token' => Str::random(10),
        ]);
    }

    public function user(): Factory
    {
        return $this->state(fn () => [
            'name' => 'User',
            'image' => 'images/usericon.png',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => 'user',
            'role' => Role::User,
            'remember_token' => Str::random(10),
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
