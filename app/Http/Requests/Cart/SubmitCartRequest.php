<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class SubmitCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "ur" => 'required|min:2|max:100',
            "inn" => 'required|numeric',
            // "ogrn" => 'required|numeric',
            "uradr" => 'required|min:2|max:100',
            "bank" => 'required|min:2|max:100',
            "bik" => 'required|numeric',
            "chet" => 'required|numeric',
            "delivery" => 'nullable|required_with:need_delivery,on|min:2|max:1000',
            "name" => 'required|string|min:2|max:100',
            "phone" => 'required|min:2|max:20',
            "email" => 'required|email',
            "comment" => 'nullable|string|min:2|max:1000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
