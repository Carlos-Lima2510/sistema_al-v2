<?php

namespace App\Services;

use App\Repositories\MarcaMaterialRepository;
use App\Exceptions\MarcaMaterialException;


class MarcaMaterialService
{
    protected $repo;

    public function __construct(MarcaMaterialRepository $repo)
    {
        $this->repo = $repo;
    }

    // private function listarMarcaMaterial()
    // {
    //     return $this->repo->getAll();
    // }

    // private function listarPorMaterial($material)
    // {
    //     return $this->repo->getByMaterial($material);
    // }

    // private function listarPorMarca($marca)
    // {
    //     return $this->repo->getByMarca($marca);
    // }

    public function filtrarMarcaMaterial(array $filtros)
{
    return $this->repo->filtrar($filtros);
}


    public function crearMarcaMaterial(array $data)
    {
        return $this->repo->create($data);
    }

    public function obtenerMarcaMaterialPorId($id_marca_material)
    {
        $marca = $this->repo->getById($id_marca_material);

        if (!$marca){
            throw new MarcaMaterialException();
        }

        return $marca;
    }
}
