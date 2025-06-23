<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VarianteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_variantes' => $this->id_variantes,
            'peso_libras' => $this->peso_libras,
            'precio_unitario' => $this->precio_unitario,
            'precio_por_mayor' => $this->precio_por_mayor,
            'stock' => $this->stock,
        ];
    }
}
