<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductoRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ])->paginate($perPage);
    }

    public function getActive()
    {
        return Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ])->where('activo', 1)->get();
    }
    public function findWithRelations(Producto $producto)
    {
        return $producto->load([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ]);
    }

    public function create(array $data): Producto
    {
        return Producto::create($data);
    }
}
