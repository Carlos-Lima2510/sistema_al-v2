<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
            'id_codigo_color' => 'nullable|exists:codigo_color,id_codigo_color',
            'costo_base' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
            'activo' => 'required|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'id_marca_material.required' => 'La combinación marca/material es obligatoria',
            'costo_base.required' => 'El costo base es requerido',
            'costo_base.numeric' => 'El costo debe ser un valor numérico válido',
            'costo_base.min' => 'El costo no puede ser negativo',
        ];
    }
}
