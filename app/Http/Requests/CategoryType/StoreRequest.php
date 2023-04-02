<?php

namespace App\Http\Requests\CategoryType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'type_id' => 'required|integer|exists:types,id',
        ];
    }
}
