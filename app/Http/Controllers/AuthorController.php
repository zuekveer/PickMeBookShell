<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::getAuthorsWithBookCount();
        return response()->json($authors);
    }

    public function store(AuthorRequest $request): JsonResponse
    {
        $author = Author::createAuthor($request->validated());
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
        $updatedAuthor = $author->updateAuthor($request->validated());
        return response()->json($updatedAuthor);
    }
}
