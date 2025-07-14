<?php

namespace App\Services;

use App\Repositories\PedidoVentaRepository;

class PedidoVentaService
{
    protected $repo;

    public function __construct(PedidoVentaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarPedidosDeVenta($perPage)
    {
        return $this->repo->getAllPaginated($perPage);
    }

    public function crearPedidoDeVenta($data)
    {
        return $this->repo->createSellOrder($data);
    }

    public function obtenerPedidoDeVenta($id)
    {
        return $this->repo->getById($id);
    }
}
