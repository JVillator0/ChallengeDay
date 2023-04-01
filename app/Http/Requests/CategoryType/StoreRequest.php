<?php

namespace App\Http\Requests\CategoryType;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'type_id' => 'required|integer|exists:types,id',
        ];
    }
}
