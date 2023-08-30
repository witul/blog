<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->firstName(),
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'role' => $this->faker->randomElement(Role::cases()),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


    /**
     * Indicate that the user is suspended.
     */
    public function role(Role $role): Factory
    {
        return $this->state(function () use ($role) {
            return [
                'role' => $role,
            ];
        });
    }

    /**
     * Indicate that the user is suspended.
     */
    public function admin(): Factory
    {
        return $this->role(Role::Admin);
    }

    /**
     * Indicate that the user is suspended.
     */
    public function editor(): Factory
    {
        return $this->role(Role::Editor);
    }

    /**
     * Indicate that the user is suspended.
     */
    public function user(): Factory
    {
        return $this->role(Role::User);
    }

}
