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

    public function esEspecificacionPorPeso(int $id)
    {
        return Especificacion::where('id_especificaciones', $id)
            ->where('nombre_especificacion', 'peso')
            ->exists();
    }
}
