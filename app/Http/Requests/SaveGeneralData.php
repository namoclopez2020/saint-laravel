<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGeneralData extends FormRequest
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
            'moneda' => 'required',
            'signo' => 'required',
            'office_id' => 'required',
            'signo_impuesto' => 'required',
            'impuesto' => 'required'
        ];
    }
}
