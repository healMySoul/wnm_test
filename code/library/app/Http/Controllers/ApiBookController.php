<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book AS BookRequest;
use App\Book;

class ApiBookController extends Controller
{
    /**
     * Список книг
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Создание книги
     *
     * @param  BookRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->validated());

        return response()->json($book, 201);
    }

    /**
     * Просмотр книги
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Обновление книги
     *
     * @param  BookRequest  $request
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return response()->json($book);
    }

    /**
     * Удаление книги
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
