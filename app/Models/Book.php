<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'title', 'annotation', 'publication_date'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public static function getPaginatedBooks($perPage = 10)
    {
        return static::with('author')->paginate($perPage);
    }

    public static function createBook(array $data): static
    {
        if (isset($data['publication_date'])) {
            $dateTime = \DateTime::createFromFormat('d-m-Y', $data['publication_date']);
            if ($dateTime !== false) {
                $data['publication_date'] = $dateTime->format('Y-m-d');
            } else {
                $data['publication_date'] = null;
            }
        }

        return static::create($data);
    }

    public static function getBookWithAuthor($id)
    {
        return static::with('author')->findOrFail($id);
    }

    public static function updateBook($id, array $data): static
    {
        $book = static::findOrFail($id);

        if (isset($data['publication_date'])) {
            $dateTime = \DateTime::createFromFormat('d-m-Y', $data['publication_date']);
            if ($dateTime !== false) {
                $data['publication_date'] = $dateTime->format('Y-m-d');
            } else {
                $data['publication_date'] = null;
            }
        }

        $book->update($data);
        return $book;
    }
}
