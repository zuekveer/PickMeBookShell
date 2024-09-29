<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'annotation' => $this->faker->paragraph(),
            'publication_date' => $this->faker->date('Y-m-d'),
            'author_id' => Author::factory(),
        ];
    }
}
