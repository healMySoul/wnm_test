<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Author;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => substr($faker->text(rand(10, 15)), 0, -1),
        'text' => $faker->text,
    ];
});

$factory->afterCreating(Book::class, function (Book $book, $faker) {
    $book->authors()->save(factory(Author::class)->create());
});
