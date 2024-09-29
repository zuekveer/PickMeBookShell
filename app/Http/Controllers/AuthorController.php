<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\JsonResponse;
use App\Utils\DateUtils;

class AuthorController extends Controller
{
    protected $dateUtils;

    public function __construct(DateUtils $dateUtils)
    {
        $this->dateUtils = $dateUtils;
    }

    public function index(): JsonResponse
    {
        $authors = Author::getAuthorsWithBookCount();
        return response()->json($authors);
    }

    public function store(AuthorRequest $request): JsonResponse
    {
        $author = Author::createAuthor($request->validated(), $this->dateUtils);
        return response()->json($author, 201);
    }

    public function show($id): JsonResponse
    {
        $author = Author::getAuthorWithBooks($id);
        return response()->json($author);
    }

    public function update(AuthorRequest $request, $id): JsonResponse
    {
        $author = Author::findOrFail($id);
        $updatedAuthor = $author->updateAuthor($request->validated(), $this->dateUtils);
        return response()->json($updatedAuthor);
    }
}
