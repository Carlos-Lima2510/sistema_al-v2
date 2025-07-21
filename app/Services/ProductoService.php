<?php

namespace App\Services;

use App\Repositories\ProductoRepository;
use App\Repositories\MarcaMaterialRepository;
use App\Repositories\CodigoColorRepository;
use App\Repositories\CategoriaRepository;
use Illuminate\Validation\ValidationException;


class ProductoService
{
    protected $productoRepository;
    protected $marcaMaterialRepository;
    protected $codigoColorRepository;
    protected $categoriaRepository;

    public function __construct(
        ProductoRepository $productoRepository,
        MarcaMaterialRepository $marcaMaterialRepository,
        CodigoColorRepository $codigoColorRepository,
        CategoriaRepository $categoriaRepository
    ) {
        $this->productoRepository = $productoRepository;
        $this->marcaMaterialRepository = $marcaMaterialRepository;
        $this->codigoColorRepository = $codigoColorRepository;
        $this->categoriaRepository = $categoriaRepository;
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

    public function mostrar($producto)
    {
        return $this->productoRepository->findWithRelations($producto);
    }

    public function validarCombinacion($idMarcaMaterial, $idCodigoColor, $idCategoria)
    {
        $marcaMaterial = $this->marcaMaterialRepository->getById($idMarcaMaterial);
        $codigoColor = $this->codigoColorRepository->getCodigoColor($idCodigoColor);
        $categoria = $this->categoriaRepository->getById($idCategoria);

        $existe = $this->productoRepository->existsProductoCombinacion($idMarcaMaterial, $idCodigoColor, $idCategoria);

        if ($existe) {
            throw ValidationException::withMessages([
                'id_marca_material' => "Ya existe un producto con marca '{$marcaMaterial->marca->nombre_marca}', " .
                    "material '{$marcaMaterial->tipo_material->nombre_material}', " .
                    "categoria '{$categoria->nombre_categoria}' " .
                    "y color '{$codigoColor->nombre_color}'"
            ]);
        }
    }

    public function crear(array $data)
    {
        return $this->productoRepository->create($data);
    }
}
