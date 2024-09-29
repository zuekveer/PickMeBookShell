<?php

namespace App\Models;

use App\Utils\DateUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'information', 'date_of_birth'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public static function getAuthorsWithBookCount($perPage = 15): LengthAwarePaginator
    {
        return static::withCount('books')
            ->orderBy('books_count', 'desc')
            ->paginate($perPage);
    }

    public static function getAuthorWithBooks($id): Builder
    {
        return static::with('books')->findOrFail($id);
    }

    public static function createAuthor(array $validatedData, DateUtils $dateUtils): static
    {
        if (isset($validatedData['date_of_birth'])) {
            $validatedData['date_of_birth'] = $dateUtils->convertDateFormat($validatedData['date_of_birth']);
        }

        return static::create($validatedData);
    }

    public function updateAuthor(array $validatedData, DateUtils $dateUtils): static
    {
        if (isset($validatedData['date_of_birth'])) {
            $validatedData['date_of_birth'] = $dateUtils->convertDateFormat($validatedData['date_of_birth']);
        }

        $this->update($validatedData);
        return $this;
    }
}
