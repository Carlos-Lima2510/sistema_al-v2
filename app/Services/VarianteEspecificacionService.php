<?php

namespace App\Services;

use App\Repositories\VarianteEspecificacionRepository;

class VarianteEspecificacionService
{
    protected $repo;
    public function __construct(VarianteEspecificacionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarVarianteEspecificaciones($perPage)
    {
        return $this->repo->getAllPaginated($perPage);
    }

    public function crearVarianteEspecificacion(array $data)
    {
        return $this->repo->create($data);
    }
}
