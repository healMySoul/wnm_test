<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'text'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');
    }
}
