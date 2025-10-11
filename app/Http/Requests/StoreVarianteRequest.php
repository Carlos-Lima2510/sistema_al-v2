<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVarianteRequest extends FormRequest
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
            'id_producto' => 'required|exists:productos,id_producto',
            'id_codigo_color' => 'nullable|exists:codigo_color,id_codigo_color',
            'precio_unitario' => 'required|numeric|min:0',
            'precio_por_mayor' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',

            'especificaciones' => 'nullable|array',
            'especificaciones.*.id_especificaciones' => 'required|exists:especificaciones,id_especificaciones',
            'especificaciones.*.valor' => 'required|string|max:100',
        ];
    }
}
