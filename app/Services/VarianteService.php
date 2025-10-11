<?php

namespace App\Services;

use App\Repositories\EspecificacionRepository;
use App\Models\Variante;
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
        return DB::transaction(function () use ($data) {
            $producto = $this->productoRepository->getById($data['id_producto']);
            $costoBase = $producto->costo_base;

            if ($peso = $this->extraerPesoDeEspecificaciones($data)) {
                $data['precio_unitario'] = $this->calcularPrecioPorPeso($peso, $costoBase);
            }

            $variante = $this->varianteRepository->create($data);
            $this->varianteRepository->asignarEspecificaciones($variante, $data['especificaciones']);

            return $variante;
        });
    }
    public function actualizar(Variante $variante, array $data)
    {
        $varianteActualizada = $this->varianteRepository->update($variante, $data);

        if (isset($data['especificaciones'])) {
            $this->validarDuplicados($data['especificaciones']);
            $this->sincronizarEspecificaciones($varianteActualizada, $data['especificaciones']);
            $this->recalcularPrecioPorPeso($varianteActualizada, $data['especificaciones']);
        }

        return $varianteActualizada->fresh(['especificaciones']);
    }

    private function validarDuplicados(array $especificaciones): void
    {
        $ids = array_column($especificaciones, 'id_especificaciones');
        $duplicados = array_diff_key($ids, array_unique($ids));

        if (!empty($duplicados)) {
            throw new \InvalidArgumentException('No puedes repetir especificaciones con el mismo ID.');
        }
    }

    private function sincronizarEspecificaciones(Variante $variante, array $especificaciones): void
    {
        $syncData = [];
        foreach ($especificaciones as $especificacion) {
            $syncData[$especificacion['id_especificaciones']] = ['valor' => $especificacion['valor']];
        }

        $variante->especificaciones()->sync($syncData);
    }

    private function recalcularPrecioPorPeso(Variante $variante, array $especificaciones): void
    {
        foreach ($especificaciones as $especificacion) {
            if ($this->especificacionRepository->esEspecificacionPorPeso($especificacion['id_especificaciones'])) {
                $nuevoPrecio = $this->calcularPrecioPorPeso(
                    (float) $especificacion['valor'],
                    $variante->producto->costo_base
                );
                $variante->precio_unitario = $nuevoPrecio;
                $variante->save();
            }
        }
    }
    public function eliminar(Variante $variante)
    {
        return $this->varianteRepository->delete($variante);
    }

    public function calcularPrecioPorPeso(float $pesoOnzas, float $costoBase) {
    $precio = ($pesoOnzas - 16) * 2.15 + $costoBase;

    // Extraemos la parte entera y decimal
    $entero = floor($precio);
    $decimal = $precio - $entero;

    // Redondeamos el decimal a .25, .50, .75 o 0
    if ($decimal < 0.125) {
        $decimalRedondeado = 0.0;
    } elseif ($decimal < 0.375) {
        $decimalRedondeado = 0.25;
    } elseif ($decimal < 0.625) {
        $decimalRedondeado = 0.50;
    } elseif ($decimal < 0.875) {
        $decimalRedondeado = 0.75;
    } else {
        $decimalRedondeado = 0.0;
        $entero += 1; // subimos al siguiente entero
    }

    return $entero + $decimalRedondeado;
}


    private function extraerPesoDeEspecificaciones(array $data)
    {
        foreach ($data['especificaciones'] as $especificacion) {
            if ($this->especificacionRepository->esEspecificacionPorPeso($especificacion['id_especificaciones'])) {
                return (float) $especificacion['valor'];
            }
        }

        return null;
    }
}
