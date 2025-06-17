<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcaMaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_marca_material' => $this->id_marca_material,
            'marca' => $this->whenLoaded('marca', function () {
                return [
                    'id_marca' => $this->marca->id_marca,
                    'nombre_marca' => $this->marca->nombre_marca,
                ];
            }),
            'tipo_material' => $this->whenLoaded('tipo_material', function () {
                return [
                    'id_tipo_material' => $this->tipo_material->id_tipo_material,
                    'nombre_material' => $this->tipo_material->nombre_material,
                ];
            }),
        ];
    }
}
