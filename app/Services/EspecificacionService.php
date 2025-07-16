<?php

namespace App\Services;

use App\Repositories\EspecificacionRepository;
class EspecificacionService
{
    protected $repo;

    public function __construct(EspecificacionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarEspecificaciones($perPage)
    {
        return $this->repo->getAllPaginated($perPage);
    }

    public function crearEspecificacion(array $data)
    {
        return $this->repo->create($data);
    }
}
