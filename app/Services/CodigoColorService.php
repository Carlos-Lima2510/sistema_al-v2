<?php

namespace App\Services;

use App\Repositories\CodigoColorRepository;

class CodigoColorService
{
    protected $repo;

    public function __construct(CodigoColorRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarCodigosColor()
    {
        return $this->repo->getAll();
    }

    public function crear($data)
    {
        return $this->repo->createCodigoColor($data);
    }

    public function obtenerCodigoColor($id)
    {
        return $this->repo->getCodigoColor($id);
    }
}
