<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Resources\ProductoResource;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:ver productos')->only(['index', 'show']);
        $this->middleware('can:crear productos')->only(['store', 'create']);
        $this->middleware('can:editar productos')->only(['update', 'edit']);
        $this->middleware('can:eliminar productos')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ])->get();

        return ProductoResource::collection($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto->load([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ]);
    
        return new ProductoResource($producto);
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
