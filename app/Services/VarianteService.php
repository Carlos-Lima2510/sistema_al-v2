<?php

namespace App\Services;

use App\Repositories\VarianteRepository;

class VarianteService
{
    protected $repo;

    public function __construct(VarianteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarTodos($perPage)
    {
        return $this->repo->getAll($perPage);
    }

    public function obtenerPorId($id)
    {
        return $this->repo->getById($id);
    }

    public function crearVariante(array $data)
    {
        return $this->repo->create($data);
    }
}
