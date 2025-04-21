<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

        return response()->json($productos);
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
    public function store(Request $request)
    {
        $producto = Producto::create($request->only([
            'id_categoria',
            'id_marca_material',
            'id_codigo_color',
            'precio_unitario',
            'precio_por_mayor',
            'stock',
            'descripcion',
            'activo',
            'fecha_registro'
        ]));

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto = Producto::with([
            'categoria',
            'marcaMaterial.marca',
            'marcaMaterial.tipo_material',
            'codigoColor'
        ])->findOrFail($producto->id_producto);

        return response()->json($producto);
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
