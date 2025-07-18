<?php

namespace App\Services;

use App\Repositories\VarianteEspecificacionRepository;
use App\Repositories\VarianteRepository;
use Illuminate\Support\Facades\DB;

class VarianteService
{
    protected $varianteRepository;
    protected $varianteEspecificacionRepository;


    public function __construct(VarianteRepository $varianteRepository, VarianteEspecificacionRepository $varianteEspecificacionRepository)
    {
        $this->varianteRepository = $varianteRepository;
        $this->varianteEspecificacionRepository = $varianteEspecificacionRepository;
    }

    public function listarTodos($perPage)
    {
        return $this->varianteRepository->getAll($perPage);
    }

    public function obtenerPorId($id)
    {
        return $this->varianteRepository->getById($id);
    }

    public function storeVarianteConEspecificaciones($data)
    {
        return DB::transaction(function () use ($data) {
            $variante = $this->varianteRepository->create($data);

            foreach ($data['especificaciones'] as $especificacion) {
                $this->varianteEspecificacionRepository->create([
                    'id_variantes' => $variante->id_variantes,
                    'id_especificaciones' => $especificacion['id_especificaciones'],
                    'valor' => $especificacion['valor'],
                ]);
            }

            return $variante;
        });
    }
}
