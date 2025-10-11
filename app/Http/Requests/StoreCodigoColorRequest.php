<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCodigoColorRequest extends FormRequest
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
            'codigo' => 'required|string',
            'nombre_color' => 'required|string',
            'codigo_hex' => [
                'required',
                'string',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],
            'id_marca_material' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'codigo_hex.regex' => 'El código HEX debe tener el formato #FFFFFF o #FFF',
        ];
    }
}
