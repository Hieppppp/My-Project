<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123456789'),
            'date_of_birth' => $this->faker->date(),
            'phone' => '09' . $this->faker->randomNumber(8, true),
            'avatar' => '1718272414.jpg',
            'verified' => 0,
            'remember_token' => null,
        ];
    }

    
}
