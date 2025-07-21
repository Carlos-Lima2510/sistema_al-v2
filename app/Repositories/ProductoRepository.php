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

    public function getFilteredPaginatedProducts(array $filters, int $perPage)
    {
        $query = Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes.especificaciones'
        ]);

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

    public function getById($id)
    {
        return Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor',
            'variantes',
        ])->findOrFail($id);
    }

    public function existsProductoCombinacion($idMarcaMaterial, $idCodigoColor, $idCategoria)
    {
        return Producto::where('id_marca_material', $idMarcaMaterial)
            ->where('id_codigo_color', $idCodigoColor)
            ->where('id_categoria', $idCategoria)
            ->exists();
    }

    public function create(array $data): Producto
    {
        return Producto::create($data);
    }
}
