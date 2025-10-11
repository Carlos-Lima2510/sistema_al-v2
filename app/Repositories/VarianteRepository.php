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
    public function getById(int $id)
    {
        return Variante::with(
            'producto',
            'codigoColor',
            'especificaciones'
        )->findOrFail($id);
    }

    public function create(array $data)
    {
        return Variante::create($data);
    }

    public function asignarEspecificaciones(Variante $variante, array $especificaciones)
    {
        foreach ($especificaciones as $especificacion) {
            VarianteEspecificacion::create([
                'id_variantes' => $variante->id_variantes,
                'id_especificaciones' => $especificacion['id_especificaciones'],
                'valor' => $especificacion['valor'],
            ]);
        }
    }

    public function update(Variante $variante, array $data)
    {
        $variante->update($data);
        return $this->getById($variante->id_variantes);
    }

    public function delete(Variante $variante)
    {
        $varianteEliminada = $this->getById($variante->id_variantes);
        $variante->delete();
        return $varianteEliminada;
    }
}
