<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author AS AuthorRequest;
use App\Author;

class AuthorController extends Controller
{
    /**
     * Список авторов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Author::all());
    }

    /**
     * Создание автора
     *
     * @param  AuthorRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return response()->json($author, 201);
    }

    /**
     * Просмотр автора
     *
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Author $author)
    {
        return response()->json($author);
    }

    /**
     * Обновление автора
     *
     * @param  AuthorRequest  $request
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return response()->json($author);
    }

    /**
     * Удаление автора
     *
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
