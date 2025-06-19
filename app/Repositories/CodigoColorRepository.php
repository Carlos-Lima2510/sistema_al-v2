<?php

namespace App\Repositories;

use App\Models\CodigoColor;

class CodigoColorRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return CodigoColor::with([
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
        ])->paginate($perPage);
    }

    public function getCodigoColor($id)
    {
        return CodigoColor::findOrFail($id);
    }

    public function createCodigoColor($data)
    {
        return CodigoColor::create($data);
    }
}
