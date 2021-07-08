<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text' => 'required|string|min:2|max:1000',
            'categoryId' => 'integer'
        ];
    }
}