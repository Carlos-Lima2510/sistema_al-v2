<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_producto,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio_unitario,
            'categoria' => $this->categoria->nombre_categoria,
            'marca' => $this->marcaMaterial->marca->nombre_marca,
            'material' => $this->marcaMaterial->tipo_material->nombre_material,
            'color' => $this->codigoColor->nombre_color,
        ];
    }
}
