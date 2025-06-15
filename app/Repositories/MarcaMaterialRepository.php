<?php

namespace App\Repositories;

use App\Models\MarcaMaterial;

class MarcaMaterialRepository
{
    public function getAll()
    {
        return MarcaMaterial::all();
    }

    public function getByMarca($marca)
    {
        return MarcaMaterial::where('marca', $marca)->get();
    }

    public function getByMaterial($material)
    {
        return MarcaMaterial::where('material', $material)->get();
    }
    
    public function create(array $data)
    {
        return MarcaMaterial::create($data);
    }
}
