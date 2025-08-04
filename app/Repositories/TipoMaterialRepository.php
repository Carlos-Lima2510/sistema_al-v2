<?php

namespace App\Repositories;

use App\Models\TipoMaterial;

class TipoMaterialRepository
{
    public function getAll()
    {
        return TipoMaterial::all();
    }

    public function findById(int $id)
    {
        return TipoMaterial::findOrFail($id);
    }

    public function create(array $data): TipoMaterial
    {
        return TipoMaterial::create($data);
    }
}
