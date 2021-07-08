<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class RandByCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'count' => 'integer',
        ];
    }
}