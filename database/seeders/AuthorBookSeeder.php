<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorBookSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory(32)->create()->each(function ($author) {
            Book::factory(16)->create([
                'author_id' => $author->id,
            ]);
        });
    }
}

