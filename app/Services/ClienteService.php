<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService
{
    protected $repo;
    public function __construct(ClienteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarClientes($perPage)
    {
        return $this->repo->getAllPaginated($perPage);
    }

    public function obtenerPorId($id)
    {
        return $this->repo->getById($id);
    }

    public function crear($data)
    {
        return $this->repo->createCliente($data);
    }
}
