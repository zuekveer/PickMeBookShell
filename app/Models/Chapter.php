<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'title', 'content'];

    // Book's relationships
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // count characters
    public function getCharacterCount(): int
    {
        return strlen($this->content);
    }
}
