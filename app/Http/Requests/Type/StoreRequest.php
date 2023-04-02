<?php

namespace App\Http\Requests\Type;

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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'unit_abbreviation' => 'required|string|max:255',
        ];
    }
}
