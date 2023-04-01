<?php

namespace App\Http\Requests\Consumption;

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
            'amount' => 'required|numeric|min:0',
            'category_type_id' => 'required|exists:category_types,id',
            'emission_type_id' => 'required|exists:emission_types,id',
            'place_id' => 'required|exists:places,id',
        ];
    }
}
