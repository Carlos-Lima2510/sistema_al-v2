<?php

namespace App\Services;

use App\Repositories\MarcaMaterialRepository;


class MarcaMaterialService
{
    protected $repo;

    public function __construct(MarcaMaterialRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarMarcaMaterial()
    {
        return $this->repo->getAll();
    }

    public function listarMarcasPorMaterial($material)
    {
        return $this->repo->getByMaterial($material);
    }

    public function listarMarcasPorMarca($marca)
    {
        return $this->repo->getByMarca($marca);
    }

    public function crearMarcaMaterial(array $data)
    {
        return $this->repo->create($data);
    }
}
