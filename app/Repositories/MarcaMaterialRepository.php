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

    // public function getByMarca($marca)
    // {
    //     return MarcaMaterial::with('marca', 'tipo_material')
    //         ->where('id_marca', $marca)
    //         ->get();
    // }

    // public function getByMaterial($material)
    // {
    //     return MarcaMaterial::with('marca', 'tipo_material')
    //         ->where('id_tipo_material', $material)
    //         ->get();
    // }

    public function filtrar(array $filtros)
{
    return MarcaMaterial::with('marca', 'tipo_material')
        ->when(isset($filtros['marca']), function($query) use ($filtros) {
            $query->where('id_marca', $filtros['marca']);
        })
        ->when(isset($filtros['tipo_material']), function($query) use ($filtros) {
            $query->where('id_tipo_material', $filtros['tipo_material']);
        })
        ->get();
}

    
    public function create(array $data)
    {
        $marcaMaterial = MarcaMaterial::create($data);
        $marcaMaterial->load('marca', 'tipo_material');
        return $marcaMaterial;
    }

    public function getById($id_marca_material)
    {
        return MarcaMaterial::with('marca', 'tipo_material')->find($id_marca_material);
    }
}
