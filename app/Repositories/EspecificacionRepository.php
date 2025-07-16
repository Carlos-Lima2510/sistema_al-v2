<?php

namespace App\Repositories;

use App\Models\Especificacion;

class EspecificacionRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Especificacion::paginate($perPage);
    }

    public function create(array $data)
    {
        return Especificacion::create($data);
    }
}
