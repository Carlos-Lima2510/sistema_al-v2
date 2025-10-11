<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoDetailedResource extends JsonResource
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
            'activo' => $this->activo,
            'variantes' => VarianteResource::collection($this->variantes),
            'categoria' => $this->whenLoaded('categoria'),
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
            'fecha_registro' => $this->fecha_registro
        ];
    }
}
