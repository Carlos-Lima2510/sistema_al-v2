<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EspecificacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_especificaciones' => $this->id_especificaciones,
            'nombre_especificacion' => $this->nombre_especificacion,
            'unidad' => $this->unidad,
            'valor' => $this->pivot->valor
        ];
    }
}
