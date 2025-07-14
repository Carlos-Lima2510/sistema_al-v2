<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id_cliente,
            'nombre_cliente' => $this->nombre_cliente,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'numero_identificacion' => $this->numero_identificacion,
            'tipo_cliente' => $this->tipo_cliente,
            'notas' => $this->notas
        ];
    }
}
