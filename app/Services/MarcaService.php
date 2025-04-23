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
        if ($this->marcaExistente($id)) {
            return $this->repo->findById($id);
        } else {
            return 'Marca no existe';
        }
    }

    private function marcaExistente($id)
    {
        if (Marca::where("id_marca", $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
