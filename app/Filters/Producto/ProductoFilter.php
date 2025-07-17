<?php

namespace App\Filters\Producto;

use Illuminate\Database\Eloquent\Builder;

class ProductoFilter
{
    public static function apply(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['id_categoria'] ?? null, function ($query, $categoriaId) {
                $query->where('id_categoria', $categoriaId);
            })
            ->when($filters['id_marca'] ?? null, function ($query, $marcaId) {
                $query->whereHas('marcaMaterial.marca', function ($marcaQuery) use ($marcaId) {
                    $marcaQuery->where('id_marca', $marcaId);
                });
            })
            ->when($filters['id_tipo_material'] ?? null, function ($query, $tipoMaterialId) {
                $query->whereHas('marcaMaterial.tipo_material', function ($tipoMaterialQuery) use ($tipoMaterialId) {
                    $tipoMaterialQuery->where('id_tipo_material', $tipoMaterialId);
                });
            })
            ->when($filters['agotado'] ?? null, function($query, $flag) {
                if ($flag) {
                    $query->whereDoesntHave('variantes', function($q) {
                        $q->where('stock', '>', 0);
                    });
                }
            });
    }
}
