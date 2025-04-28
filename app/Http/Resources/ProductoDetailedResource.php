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
            'precio_unitario' => $this->precio_unitario,
            'precio_por_mayor' => $this->precio_por_mayor,
            'activo' => $this->activo,
            'stock' => $this->stock,
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
            'codigo_color' => $this->whenLoaded('codigoColor'),
            'fecha_registro' => $this->fecha_registro
        ];
    }
}
