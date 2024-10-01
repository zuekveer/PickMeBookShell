<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Models\Chapter;
use Illuminate\Http\JsonResponse;
use App\Utils\DateUtils;
use Illuminate\Http\Request;

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

    public function addChapter(Request $request, $bookId): JsonResponse
    {
        $book = Book::findOrFail($bookId);
        $chapter = $book->chapters()->create($request->only('title', 'content'));

        // update total character count
        $book->updateTotalCharacterCount();

        return response()->json($chapter, 201);
    }

    // update chapter
    public function updateChapter(Request $request, $bookId, $chapterId): JsonResponse
    {
        $book = Book::findOrFail($bookId);
        $chapter = Chapter::findOrFail($chapterId);
        $chapter->update($request->only('title', 'content'));

        // update total character count
        $book->updateTotalCharacterCount();

        return response()->json($chapter);
    }


}
