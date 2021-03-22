<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Book;
use App\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        $authors = [];

        for ($i = 1; $i <= 3; $i++) {
            $books[] = Book::create([
                'title' => Str::random(10),
                'text' => Str::random(100),
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            $authors[] = Author::create([
                'name' => Str::random(3) . ' ' . Str::random(3),
            ]);
        }

        foreach ($books as $book) {
            /* @var Book $book*/
            $book->authors()->save($authors[rand(0, 2)]);
        }
    }
}
