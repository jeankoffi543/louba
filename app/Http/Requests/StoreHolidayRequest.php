<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'date' => 'required|date',
            // 'id_point_enrolement' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'La raison du jour férié est requise',
            'date.required' => 'La date est requise',
            'id_point_enrolement.required' => 'Le point d\'enrolement est nécéssaire'
        ];
    }
}
