<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\User;

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

Route::middleware('auth:api')->group(function () {
    Route::post('/books', 'Api\BookController@store');
    Route::put('/books/{book}', 'Api\BookController@update');
    Route::delete('/books/{book}', 'Api\BookController@destroy');

    Route::post('/authors', 'Api\AuthorController@store');
    Route::put('/authors/{author}', 'Api\AuthorController@update');
    Route::delete('/authors/{author}', 'Api\AuthorController@destroy');

    Route::post('logout', function () {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    });
});

Route::middleware('api')->group(function () {
    Route::get('/books', 'Api\BookController@index');
    Route::get('/books/{book}', 'Api\BookController@show');

    Route::get('/authors', 'Api\AuthorController@index');
    Route::get('/authors/{author}', 'Api\AuthorController@show');

    // Регистрация юзера
    Route::post('/users', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json($user, 201);
    });

    // Аутентификация юзера
    Route::get('/login', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json($token);
    });
});

/**
 * Если не найден ни один роут, показываем сообщение
 * Работает только для GET-запросов, особенность Laravel
 */
Route::fallback(function() {
    return response()->json(['message' => 'Method is not allowed.'], 404);
});
