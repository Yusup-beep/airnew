<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;

class SubmitSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "query" => 'required|min:1|max:100',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
