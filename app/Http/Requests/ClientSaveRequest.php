<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSaveRequest extends FormRequest
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
            'nombre' =>'required',
            'telefono' => 'required|min:8',
            'direccion' => 'required',
            'email' => 'required',
            'documento_id' => 'required',
            'pedidos' => 'required',
            'credito_max' => 'required',
            'nro_documento' => 'required',
            
           // 'credito_restante' => 'required',
            
        ];
    }
}
