<?php

namespace App\Repositories;

use App\Models\VarianteEspecificacion;

class VarianteEspecificacionRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return VarianteEspecificacion::paginate($perPage);
    }

    public function create(array $data)
    {
        return VarianteEspecificacion::create($data);
    }
}
