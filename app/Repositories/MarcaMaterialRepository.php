<?php

namespace App\Repositories;

use App\Models\MarcaMaterial;

class MarcaMaterialRepository
{
    public function getAll()
    {
        return MarcaMaterial::with([
            'marca',
            'tipo_material'
        ])->get();
    }

    public function filters(array $filtros)
    {
        return MarcaMaterial::with('marca', 'tipo_material')
            ->when(isset($filtros['marca']), function ($query) use ($filtros) {
                $query->where('id_marca', $filtros['marca']);
            })
            ->when(isset($filtros['tipo_material']), function ($query) use ($filtros) {
                $query->where('id_tipo_material', $filtros['tipo_material']);
            })
            ->get();
    }

    public function create(array $data)
    {
        return MarcaMaterial::create($data)
            ->load('marca', 'tipo_material');
    }

    public function getById($id_marca_material)
    {
        return MarcaMaterial::with('marca', 'tipo_material')->find($id_marca_material);
    }
}
