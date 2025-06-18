<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\CategoriaService;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoriaCollection;

class CategoriaController extends Controller
{
    protected $service;
    public function __construct(CategoriaService $service)
    {
        $this->middleware('can:ver categorias')->only(['index', 'show']);
        $this->middleware('can:crear categorias')->only(['store', 'create']);
        $this->middleware('can:editar categorias')->only(['update', 'edit']);
        $this->middleware('can:eliminar categorias')->only(['destroy']);

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = $this->service->listarCategorias();
        return new CategoriaCollection($categorias);
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
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = $this->service->crear($request->validated());
        return response()->json(new CategoriaResource($categoria), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        $categoria = $this->service->obtenerPorId($categoria->id_categoria);
        return new CategoriaResource($categoria);
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
