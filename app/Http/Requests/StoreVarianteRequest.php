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
            'peso_libras' => 'nullable|numeric',
            'precio_unitario' => 'required|numeric',
            'precio_por_mayor' => 'required|numeric',
            'stock' => 'required|numeric'
        ];
    }
}
