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

    public function filtrarMarcaMaterial(array $filtros)
    {
        return $this->repo->filters($filtros);
    }
    
    public function crearMarcaMaterial(array $data)
    {
        return $this->repo->create($data);
    }

    public function obtenerMarcaMaterialPorId($id_marca_material)
    {
        return $this->repo->getById($id_marca_material);
    }
}
