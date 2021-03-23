<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Book extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $book = $this->route('book');

        return [
            'title' => 'required|max:255|unique:books,title,' . $book->id,
            'text' => 'required',
            'author_ids' => 'required|array|',
            'author_ids.*' => 'exists:authors,id',
        ];
    }
}
