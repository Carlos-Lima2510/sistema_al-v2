<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VarianteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_variantes' => $this->id_variantes,
            'id_producto' => $this->id_producto,
            'precio_unitario' => $this->precio_unitario,
            'precio_por_mayor' => $this->precio_por_mayor,
            'stock' => $this->stock,
        ];
    }
}
