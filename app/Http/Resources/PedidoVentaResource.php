<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PedidoVentaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pedido_venta' => $this->id_pedido_venta,
            'cliente' => $this->whenLoaded('cliente'),
            'fecha_pedido' => $this->fecha_pedido,
            'metodo_pago' => $this->metodo_pago,
            'estado' => $this->estado,
            'total' => $this->total,
            'observaciones' => $this->observaciones
        ];
    }
}
