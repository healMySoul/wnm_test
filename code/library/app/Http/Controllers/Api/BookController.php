<?php

namespace App\Http\Controllers\Api;

use App\Author;
use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book AS BookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    /**
     * Список книг
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $author = (request()->input('author'));

        if ($author !== null) {
            $books = Book::whereHas('authors', function (Builder $query) use ($author) {
                $query->where('name', 'like', "%{$author}%");
            })->get();
        } else {
            $books = Book::all();
        }

        return response()->json(BookResource::collection($books));
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
        $authors = Author::whereIn('id', $request->input('author_ids'))->get();
        $book->authors()->saveMany($authors);

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
        return response()->json(new BookResource($book));
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
        $authors = Author::whereIn('id', $request->input('author_ids'))->get();
        $book->authors()->detach();
        $book->authors()->saveMany($authors);

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
