<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // trueにしないとリクエストが弾かれます
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ];
    }
}
