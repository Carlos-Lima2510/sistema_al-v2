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
            'id_marca_material' => $this->id_marca_material,
        ];
    }
}
