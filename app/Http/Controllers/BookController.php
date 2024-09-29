<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\JsonResponse;
use App\Utils\DateUtils;

class BookController extends Controller
{
    protected $dateUtils;

    public function __construct(DateUtils $dateUtils)
    {
        $this->dateUtils = $dateUtils;
    }

    public function index(): JsonResponse
    {
        $books = Book::getPaginatedBooks();
        return response()->json($books);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::createBook($request->validated(), $this->dateUtils);
        return response()->json($book, 201);
    }

    public function show($id): JsonResponse
    {
        $book = Book::getBookWithAuthor($id);
        return response()->json($book);
    }

    public function update(BookRequest $request, $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $updatedBook = $book->updateBook($request->validated(), $this->dateUtils);
        return response()->json($updatedBook);
    }
}
