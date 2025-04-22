<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver categorias')->only(['index', 'show']);
        $this->middleware('can:crear categorias')->only(['store', 'create']);
        $this->middleware('can:editar categorias')->only(['update', 'edit']);
        $this->middleware('can:eliminar categorias')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categoria::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Categoria::create($request->only(
            'nombre_categoria'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return Categoria::findOrFail($categoria->id_categoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
