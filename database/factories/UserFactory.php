<?php

namespace Database\Factories;

use Haruncpi\LaravelIdGenerator\IdGenerator;
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
    public function definition()
    {
        $user = [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar' => 'default-avatar.png',
        ];

        $user['role_id'] = rand(1, 3);

        if ($user['role_id'] == 3) {
            $user['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'HS' . date('y'), 'reset_on_prefix_change' => true]);
        }
        if ($user['role_id'] == 1) {
            $user['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'AD' . date('y'), 'reset_on_prefix_change' => true]);
        }
        if ($user['role_id'] == 2) {
            $user['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'GV' . date('y'), 'reset_on_prefix_change' => true]);
        }

        return $user;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
