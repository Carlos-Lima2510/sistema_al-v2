<?php

namespace App\Repositories;

use App\Models\PedidoVenta;

class PedidoVentaRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return PedidoVenta::with([
            'cliente'
        ])->paginate($perPage);
    }

    public function getById($id)
    {
        return PedidoVenta::with([
            'cliente'
        ])->findOrFail($id);
    }

    public function createSellOrder(array $data)
    {
        return PedidoVenta::create($data);
    }
}
