<?php

namespace App\Filters\Producto;

use Illuminate\Database\Eloquent\Builder;

class ProductoFilter
{
    public static function apply(Builder $query, array $filters): Builder
    {
        return $query
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
            ->when(isset($filters['agotado']), function ($query) use ($filters) {
                if ($filters['agotado']) {
                    $query->whereDoesntHave('variantes', function ($q) {
                        $q->where('stock', '>', 0);
                    });
                } else {
                    $query->whereHas('variantes', function ($q) {
                        $q->where('stock', '>', 0);
                    });
                }
            })
            ->when($filters['especificaciones'] ?? null, function ($query, $especificaciones) {
                $query->whereHas('variantes.especificaciones', function ($q) use ($especificaciones) {
                    foreach ($especificaciones as $espec) {
                        $q->where('nombre_especificacion', $espec['nombre'])
                          ->where('variante_especificaciones.valor', $espec['operador'] ?? '=', $espec['valor']);
                    }
                });
            });
    }   
}
