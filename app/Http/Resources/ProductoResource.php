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
            'precio_unitario' => $this->precio_unitario,
            'precio_de_mayoreo' => $this->precio_por_mayor,
            'categoria' => $this->categoria->nombre_categoria,
            'marca' => $this->marcaMaterial->marca->nombre_marca,
            'material' => $this->marcaMaterial->tipo_material->nombre_material,
            'color' => $this->codigoColor->nombre_color,
            'stock' => $this->stock,
            'fecha_registro' => $this->fecha_registro,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
