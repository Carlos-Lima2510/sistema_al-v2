<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_cliente' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required|digits:8',
            'direccion' => 'required|string',
            'numero_identificacion' => 'required|string|size:10|unique:clientes,numero_identificacion',
            'tipo_cliente' => 'required|string',
            'notas' => 'nullable|string',
        ];
    }
}
