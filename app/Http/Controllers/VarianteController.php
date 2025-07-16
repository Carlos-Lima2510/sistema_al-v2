<?php

namespace App\Http\Controllers;

use App\Http\Resources\VarianteResource;
use App\Services\VarianteService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \App\Models\Variante;
use \App\Models\Producto;
use \App\Http\Requests\StoreVarianteRequest;

class VarianteController extends Controller
{
    protected $service;
    public function __construct(VarianteService $service)
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
        $variantes = $this->service->listarTodos($perPage);

        return response()->json([
            'data' => VarianteResource::collection($variantes->items()),
            'total' => $variantes->total(),
            'success' => true,
            'message' => 'Variantes recuperados correctamente'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVarianteRequest $request)
    {
        $variante = $this->service->storeVarianteConEspecificaciones($request->validated());
        return response()->json(['message' => 'Variante creada correctamente.', 'variante' => $variante], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Variante $variante)
    {
        $variante = $this->service->obtenerPorId($variante->id_variantes);
        return new VarianteResource($variante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variante $variante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variante $variante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variante $variante)
    {
        //
    }
}
