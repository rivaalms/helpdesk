<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisterRequest>
 */
class RegisterRequestFactory extends Factory
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
            // 'user_role_id' => mt_rand(1, 2),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->e164PhoneNumber(),
            'departement_id' => mt_rand(1,4),
            'telegram_username' => $this->faker->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
        ];
        
    }
}
