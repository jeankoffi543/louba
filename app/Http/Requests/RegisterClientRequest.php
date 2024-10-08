<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterClientRequest extends FormRequest
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
        $lengthNumber = env('LENGTH_NUMBER', 9);

        return [
            'email' => 'required|email|unique:client,email_client',
            'telephone' => "required|max:$lengthNumber|min:$lengthNumber|unique:client,telephone_client",
            'nom' => 'required|string',
            'prenom' => 'required|string',
        ];
    }

    public function messages()
    {
        $lengthNumber = env('LENGTH_NUMBER', 9);

        return [
            'required' => ":attribute est obligatoire.",
            'min' => "Numero de telephone est de $lengthNumber chiffres",
            'max' => "Numero de telephone est de $lengthNumber chiffres",
        ]; // TODO: Change the autogenerated stub
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => $validator->errors()->first(),
            "errors" => $validator->errors()
        ]));
    }
}
