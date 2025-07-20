<?php

namespace App\Repositories;

use App\Models\Variante;
use App\Models\VarianteEspecificacion;
use Illuminate\Support\Facades\DB;

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

    public function asignarEspecificaciones(Variante $variante, array $especificaciones)
    {
        foreach($especificaciones as $especificacion){
                VarianteEspecificacion::create([
                    'id_variantes' => $variante->id_variantes,
                    'id_especificaciones' => $especificacion['id_especificaciones'],
                    'valor' => $especificacion['valor'],
                ]);
            }
    }

    public function findByProducto($productoId)
    {
        return Variante::where('id_producto', $productoId)->get();
    }
}
