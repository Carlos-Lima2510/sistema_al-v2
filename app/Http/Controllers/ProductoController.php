<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoDetailedResource;
use App\Models\Producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Resources\ProductoCollection;
use App\Http\Resources\ProductoResource;

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
        $perPage = $request->input('per_page', 10);
        $productos = $this->service->listarTodos($perPage);

        return response()->json([
            'data' => ProductoResource::collection($productos->items()),
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
        return new ProductoDetailedResource($producto);
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
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
