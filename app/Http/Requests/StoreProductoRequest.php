<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'id_marca_material' => 'required|exists:marca_material,id_marca_material',
            'id_codigo_color' => 'required|exists:codigo_color,id_codigo_color',
            'costo_base' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'activo' => 'required|boolean',
            'fecha_registro' => 'required|date'
        ];
    }
}
