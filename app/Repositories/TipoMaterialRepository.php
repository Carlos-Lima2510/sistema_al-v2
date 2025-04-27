<?php

namespace App\Repositories;

use App\Models\TipoMaterial;

class TipoMaterialRepository
{
    public function getAll()
    {
        return TipoMaterial::all();
    }

    public function findById($id)
    {
        return TipoMaterial::find($id);
    }

    public function create(array $data): TipoMaterial
    {
        return TipoMaterial::create($data);
    }
}
