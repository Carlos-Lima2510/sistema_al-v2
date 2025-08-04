<?php

namespace App\Services;

use App\Models\TipoMaterial;
use App\Repositories\TipoMaterialRepository;

class TipoMaterialService
{
    protected $repo;

    public function __construct(TipoMaterialRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarMateriales()
    {
        return $this->repo->getAll();
    }

    public function getMaterial(int $id)
    {
        return $this->repo->findById($id);
    }

    public function crear(array $data)
    {
        return $this->repo->create($data);
    }
}
