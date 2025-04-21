<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
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
        $request->validate([
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'id_marca_material' => 'required|exists:marca_material,id_marca_material',
            'id_codigo_color' => 'required|exists:codigo_color,id_codigo_color',
            'precio_unitario' => 'required|numeric',
            'precio_por_mayor' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
            'activo' => 'required|boolean',
        ]);
    
        $producto = Producto::create($request->all());
    
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
