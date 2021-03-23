<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Book AS BookRequest;
use App\Book;

class ApiBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
    }
}
