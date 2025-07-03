<?php

namespace App\Repositories;

use App\Models\Variante;
use App\Models\Producto;

class VarianteRepository
{
    public function getAll(int $perPage = 10)
    {
        return Variante::with('producto')->paginate($perPage);
    }
    public function getById(int $id){
        return Variante::with('producto')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Variante::create($data);
    }

    public function findByProducto($productoId)
    {
        return Variante::where('id_producto', $productoId)->get();
    }
}
