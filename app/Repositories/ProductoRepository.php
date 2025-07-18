<?php

namespace App\Repositories;

use App\Filters\Producto\ProductoFilter;
use App\Models\Producto;

class ProductoRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes'
        ])->paginate($perPage);
    }

    public function getFilteredPaginatedProducts(array $filters, int $perPage = 10)
    {
        $query = Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes.especificaciones'
        ]);

        if (isset($filters['especificaciones'])) {
        $filters['especificaciones'] = is_string($filters['especificaciones'])
            ? json_decode($filters['especificaciones'], true)
            : $filters['especificaciones'];
        }

        $filteredQuery = ProductoFilter::apply($query, $filters);

        return $filteredQuery->paginate($perPage);
    }

    public function getActive()
    {
        return Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes',
        ])->where('activo', 1)->get();
    }
    public function findWithRelations(Producto $producto)
    {
        return $producto->load([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes',
        ]);
    }

    public function create(array $data): Producto
    {
        return Producto::create($data);
    }
}
