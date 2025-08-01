<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoDetailedResource;
use App\Models\Producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Http\Resources\ProductoCollection;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductoResourceSinColor;

class ProductoController extends Controller
{
    protected $service;
    public function __construct(ProductoService $service)
    {
        $this->middleware('can:ver productos')->only(['index', 'show']);
        $this->middleware('can:crear productos')->only(['store', 'create']);
        $this->middleware('can:editar productos')->only(['update', 'edit']);
        $this->middleware('can:eliminar productos')->only(['destroy']);

        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'id_categoria',
            'id_marca',
            'id_tipo_material',
            'agotado',
            'especificaciones'
        ]);

        $perPage = $request->input('per_page', 10);

        $productos = $this->service->listarFiltrados($filters, $perPage);

        return response()->json([
            'data' => ProductoResource::collection($productos),
            'total' => $productos->total(),
            'success' => true,
            'message' => 'Productos recuperados correctamente'
        ]);
    }

    public function activos()
    {
        $productos = $this->service->listarActivos();
        return ProductoResource::collection($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = $this->service->crear($request->validated());
        return response()->json(new ProductoResource($producto), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto = $this->service->mostrar($producto);
        return response()->json(new ProductoDetailedResource($producto), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $productoActualizado = $this->service->actualizar($producto, $request->validated());
        return response()->json(new ProductoResource($productoActualizado), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $productoEliminado = $this->service->eliminar($producto);
        return response()->json(new ProductoDetailedResource($productoEliminado), 200);
    }
}
