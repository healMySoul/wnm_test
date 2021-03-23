<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::get('/books', 'Api\BookController@index');
    Route::get('/books/{book}', 'Api\BookController@show');
    Route::post('/books', 'Api\BookController@store');
    Route::put('/books/{book}', 'Api\BookController@update');
    Route::delete('/books/{book}', 'Api\BookController@destroy');

    Route::get('/authors', 'Api\AuthorController@index');
    Route::get('/authors/{author}', 'Api\AuthorController@show');
    Route::post('/authors', 'Api\AuthorController@store');
    Route::put('/authors/{author}', 'Api\AuthorController@update');
    Route::delete('/authors/{author}', 'Api\AuthorController@destroy');
});

/**
 * Если не найден ни один роут, показываем сообщение
 * Работает только для GET-запросов, особенность Laravel
 */
Route::fallback(function(){
    return response()->json(['message' => 'Method is not allowed.'], 404);
});
