<?php

namespace App\Services;

use App\Models\Producto;
use App\Repositories\ProductoRepository;
use App\Repositories\MarcaMaterialRepository;
use App\Repositories\CodigoColorRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\EspecificacionRepository;
use Illuminate\Validation\ValidationException;


class ProductoService
{
    protected $productoRepository;
    protected $marcaMaterialRepository;
    protected $codigoColorRepository;
    protected $categoriaRepository;
    protected $especificacionRepository;
    protected $varianteService;

    public function __construct(
        ProductoRepository $productoRepository,
        MarcaMaterialRepository $marcaMaterialRepository,
        CodigoColorRepository $codigoColorRepository,
        CategoriaRepository $categoriaRepository,
        EspecificacionRepository $especificacionRepository,
        VarianteService $varianteService
    ) {
        $this->productoRepository = $productoRepository;
        $this->marcaMaterialRepository = $marcaMaterialRepository;
        $this->codigoColorRepository = $codigoColorRepository;
        $this->categoriaRepository = $categoriaRepository;
        $this->especificacionRepository = $especificacionRepository;
        $this->varianteService = $varianteService;
    }

    public function listarTodos($perPage)
    {
        return $this->productoRepository->getAllPaginated($perPage);
    }

    public function listarFiltrados(array $filters, int $perPage)
    {
        return $this->productoRepository->getFilteredPaginatedProducts($filters, $perPage);
    }

    public function listarActivos()
    {
        return $this->productoRepository->getActive();
    }

    public function mostrar($idProducto)
    {
        return $this->productoRepository->getById($idProducto);
    }

    public function validarCombinacion($idMarcaMaterial, $idCodigoColor, $idCategoria)
    {
        $marcaMaterial = $this->marcaMaterialRepository->getById($idMarcaMaterial);
        $categoria = $this->categoriaRepository->getById($idCategoria);

        $codigoColor = null;
        if ($codigoColor) {
            $codigoColor = $this->codigoColorRepository->getCodigoColor($idCodigoColor);
        }

        $existe = $this->productoRepository->existsProductoCombinacion($idMarcaMaterial, $idCodigoColor, $idCategoria);

        if ($existe) {
            throw ValidationException::withMessages([
                'id_marca_material' => "Ya existe un producto con marca '{$marcaMaterial->marca->nombre_marca}', " .
                    "material '{$marcaMaterial->tipo_material->nombre_material}', " .
                    "categoria '{$categoria->nombre_categoria}' " .
                    "y color '" . ($codigoColor ? $codigoColor->nombre_color : 'Sin color') . "'"
            ]);
        }
    }

    public function crear(array $data)
    {
        $this->validarCombinacion(
            $data['id_marca_material'],
            $data['id_codigo_color'] ?? null,
            $data['id_categoria']
        );

        return $this->productoRepository->create($data);
    }

    public function actualizar(Producto $producto, array $data)
    {
        $costoBaseAnterior = $producto->costo_base;
        $productoActualizado = $this->productoRepository->update($producto, $data);

        if (isset($data['costo_base']) && $data['costo_base'] != $costoBaseAnterior){
            foreach ($productoActualizado->variantes as $variante){
                $peso = null;
                foreach ($variante->especificaciones as $especificacion){
                    if ($this->especificacionRepository->esEspecificacionPorPeso($especificacion->id_especificaciones)){
                       $peso = (float) $especificacion->pivot->valor;
                       break;
                    }
                }
                if ($peso != null){
                    $nuevoPrecio = $this->varianteService->calcularPrecioPorPeso($peso, $data['costo_base']);
                    $variante->precio_unitario = $nuevoPrecio;
                    $variante->save();
                }
            }
        }
        
        return $productoActualizado;
    }

    public function eliminar(Producto $producto)
    {
        return $this->productoRepository->delete($producto);
    }
}
