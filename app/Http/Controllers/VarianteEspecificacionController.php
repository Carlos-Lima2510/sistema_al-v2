<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVarianteEspecificacionRequest;
use App\Http\Requests\UpdateVarianteEspecificacionRequest;
use App\Models\VarianteEspecificacion;
use App\Services\VarianteEspecificacionService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class VarianteEspecificacionController extends Controller
{
    protected $service;

    public function __construct(VarianteEspecificacionService $service)
    {
        $this->middleware('can:ver especificaciones')->only(['index', 'show']);
        $this->middleware('can:crear especificaciones')->only(['store', 'create']);
        $this->middleware('can:editar especificaciones')->only(['update', 'edit']);
        $this->middleware('can:eliminar especificaciones')->only(['destroy']);

        $this->service = $service;
    }
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $especificaciones = $this->service->listarVarianteEspecificaciones($perPage);

        return response()->json([
            'data' => EspecificacionResource::collection($especificaciones->items()),
            'total' => $especificaciones->total(),
            'success' => true,
            'message' => 'Variante-Especificaciones recuperados correctamente'
        ]);
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
    public function store(StoreVarianteEspecificacionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VarianteEspecificacion $varianteEspecificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VarianteEspecificacion $varianteEspecificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVarianteEspecificacionRequest $request, VarianteEspecificacion $varianteEspecificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VarianteEspecificacion $varianteEspecificacion)
    {
        //
    }
}
