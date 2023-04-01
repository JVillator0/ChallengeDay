<?php

namespace App\Http\Requests\Type;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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
