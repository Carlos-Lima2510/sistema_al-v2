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
            'costo_base' => $this->costo_base,
            'tipo_valuacion' => $this->tipo_valuacion,
            'categoria' => $this->categoria->nombre_categoria,
            'marca' => $this->marcaMaterial->marca->nombre_marca,
            'material' => $this->marcaMaterial->tipo_material->nombre_material,
            'variantes' => VarianteResource::collection($this->variantes),
            'color' => $this->codigoColor->nombre_color,
            'fecha_registro' => $this->fecha_registro,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
