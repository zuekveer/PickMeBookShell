<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::getPaginatedBooks();
        return response()->json($books);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::createBook($request->validated());
        return response()->json($book, 201);
    }

    public function show($id): JsonResponse
    {
        $book = Book::getBookWithAuthor($id);
        return response()->json($book);
    }

    public function update(BookRequest $request, $id): JsonResponse
    {
        $book = Book::updateBook($id, $request->validated());
        return response()->json($book);
    }
}
