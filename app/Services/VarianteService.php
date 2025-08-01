<?php

namespace App\Services;

use App\Repositories\EspecificacionRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\VarianteRepository;
use Illuminate\Support\Facades\DB;

class VarianteService
{
    protected $varianteRepository;
    protected $especificacionRepository;
    protected $productoRepository;


    public function __construct(VarianteRepository $varianteRepository, EspecificacionRepository $especificacionRepository, ProductoRepository $productoRepository)
    {
        $this->varianteRepository = $varianteRepository;
        $this->especificacionRepository = $especificacionRepository;
        $this->productoRepository = $productoRepository;
    }

    public function listarTodos($perPage)
    {
        return $this->varianteRepository->getAll($perPage);
    }

    public function obtenerPorId($id)
    {
        return $this->varianteRepository->getById($id);
    }

    public function storeVarianteConEspecificaciones(array $data)
    {
        return DB::transaction(function () use ($data){
            $producto = $this->productoRepository->getById($data['id_producto']);
            $costoBase = $producto->costo_base;

            if ($peso = $this->extraerPesoDeEspecificaciones($data)){
                $data['precio_unitario'] = $this->calcularPrecioPorPeso($peso, $costoBase);
            }

            $variante = $this->varianteRepository->create($data);
            $this->varianteRepository->asignarEspecificaciones($variante, $data['especificaciones']);

            return $variante;
        });
    }

    public function calcularPrecioPorPeso(float $pesoOnzas, float $costoBase)
    {
        $precio = ($pesoOnzas - 16) * 2.15 + $costoBase;
        return round($precio, 2);
    }

    private function extraerPesoDeEspecificaciones(array $data)
    {
        foreach($data['especificaciones'] as $especificacion){
            if ($this->especificacionRepository->esEspecificacionPorPeso($especificacion['id_especificaciones'])){
                return (float) $especificacion['valor'];
            }
        }
        
        return null;
    }
}
