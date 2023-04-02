<?php

namespace App\Http\Requests\Trip;

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
            'deparment_id' => 'required|exists:deparments,id',
            'emission_type_id' => 'required|exists:emission_types,id',
            'trip_date' => 'required|date',
        ];
    }
}
