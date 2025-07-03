<?php

namespace App\Services;

use \App\Repositories\CategoriaRepository;

class CategoriaService
{
    protected $repo;
    public function __construct(CategoriaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarCategorias()
    {
        return $this->repo->getAll();
    }

    public function obtenerPorId($id){
        return $this->repo->getById($id);
    }

    public function crear($categorias){
        return $this->repo->create($categorias);
    }
}
