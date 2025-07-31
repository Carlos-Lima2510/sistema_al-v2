<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;
use App\Models\MarcaMaterial;
use App\Models\CodigoColor;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'id_marca_material' => 'required|exists:marca_material,id_marca_material',
            'id_codigo_color' => 'nullable|exists:codigo_color,id_codigo_color',
            'costo_base' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
            'activo' => 'required|boolean',
            'fecha_registro' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'id_marca_material.required' => 'La combinación marca/material es obligatoria',
            'costo_base.required' => 'El costo base es requerido',
            'costo_base.numeric' => 'El costo debe ser un valor numérico válido',
            'costo_base.min' => 'El costo no puede ser negativo',
            'fecha_registro.required' => 'La fecha de registro es obligatoria'
        ];
    }
}