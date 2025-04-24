<?php

namespace App\Services;

use App\Repositories\ProductoRepository;

class ProductoService
{
    protected $repo;

    public function __construct(ProductoRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarTodos()
    {
        return $this->repo->getAll();
    }

    public function listarActivos()
    {
        return $this->repo->getActive();
    }

    public function mostrar($producto) {
        return $this->repo->findWithRelations($producto);
    }

    public function crear(array $data)
    {
        return $this->repo->create($data);
    }
}
