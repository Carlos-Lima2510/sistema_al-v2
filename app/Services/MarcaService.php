<?php

namespace App\Services;

use App\Repositories\MarcaRepository;
use App\Models\Marca;

class MarcaService
{
    protected $repo;
    public function __construct(MarcaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarMarcas()
    {
        return $this->repo->getAll();
    }

    public function getMarca($id)
    {
        return $this->repo->findById($id);
    }

    public function crearMarca(array $data)
    {
        return $this->repo->create($data);
    }
}
