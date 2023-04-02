<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'emission_type_id' => 'required|exists:emission_types,id',
            'trip_date' => 'required|date',
        ];
    }
}
