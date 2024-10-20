<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class CallbackRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
