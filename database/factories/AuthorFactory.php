<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'information' => $this->faker->paragraph(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
        ];
    }
}
