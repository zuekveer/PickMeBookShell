<?php

namespace App\Models;

use App\Utils\DateUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'title', 'annotation', 'publication_date'];

    // Book's relationships
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public static function getPaginatedBooks($perPage = 10)
    {
        return static::with('author')->paginate($perPage);
    }

    public static function createBook(array $data, DateUtils $dateUtils): static
    {
        if (isset($data['publication_date'])) {
            $data['publication_date'] = $dateUtils->convertDateFormat($data['publication_date']);
        }

        return static::create($data);
    }

    public static function getBookWithAuthor($id)
    {
        return static::with('author')->findOrFail($id);
    }

    public function updateBook(array $data, DateUtils $dateUtils): static
    {
        if (isset($data['publication_date'])) {
            $data['publication_date'] = $dateUtils->convertDateFormat($data['publication_date']);
        }

        $this->update($data);
        return $this;
    }

    public function updateTotalCharacterCount(): void
    {
        $totalCharacters = $this->chapters->sum(fn($chapter) => $chapter->getCharacterCount());
        $this->update(['total_character_count' => $totalCharacters]);
    }
}

