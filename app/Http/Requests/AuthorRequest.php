<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => 'required|string|min:2|max:40',
            'information' => 'nullable|string|max:1000',
            'date_of_birth' => 'nullable|date_format:d-m-Y',
        ];
    }
}
