<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'director' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:100'],
            'release_year' => [
                'required', 'integer', 'min:1888', 'max:2026',
            ],
            'duration' => [
                'required', 'integer', 'min:1', 'max:65535',
            ],
            'synopsis' => ['nullable', 'string'],
        ];
    }
}