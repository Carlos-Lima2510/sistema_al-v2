<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CodigoColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_codigo_color,
            'codigo' => $this->codigo,
            'nombre_color' => $this->nombre_color,
            'marca_material' => $this->whenLoaded('marcaMaterial', function () {
                return [
                    'id_marca_material' => $this->marcaMaterial->id_marca_material,
                    'marca' => $this->marcaMaterial->marca ? [
                        'id_marca' => $this->marcaMaterial->marca->id_marca,
                        'nombre_marca' => $this->marcaMaterial->marca->nombre_marca,
                    ] : null,
                    'tipo_material' => $this->marcaMaterial->tipo_material ? [
                        'id_tipo_material' => $this->marcaMaterial->tipo_material->id_tipo_material,
                        'nombre_material' => $this->marcaMaterial->tipo_material->nombre_material,
                    ] : null,
                ];
            }),
        ];
    }
}
