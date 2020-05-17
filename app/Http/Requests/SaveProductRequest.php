<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
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
            'nombre' => 'required',
            'codigo' => 'required|unique',
            'costo_anterior' => 'required',
            'costo_promedio' => 'required',
            'costo_actual' => 'required',
            'precio1' => 'required',
            'precio2' => 'required',
            'precio3' => 'required',
            'categorie_id' => 'required',
            'es_serial' => 'required',
            'warehouse_id' => 'required',
            'usa_empaque' => 'required',
            'medida_und' => 'required',
            'min_und' => 'required'



        ];
    }
}
