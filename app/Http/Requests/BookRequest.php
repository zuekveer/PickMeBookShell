<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|min:2|max:100',
            'annotation' => 'nullable|string|max:1000',
            'publication_date' => 'required|date_format:d-m-Y',
        ];
    }
}
