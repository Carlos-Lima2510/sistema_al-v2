<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEspecificacionRequest;
use App\Http\Requests\UpdateEspecificacionRequest;
use App\Http\Resources\EspecificacionResource;
use App\Models\Especificacion;
use App\Services\EspecificacionService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class EspecificacionController extends Controller
{
    protected $service;

    public function __construct(EspecificacionService $service)
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
        $especificaciones = $this->service->listarEspecificaciones($perPage);

        return response()->json([
            'data' => EspecificacionResource::collection($especificaciones->items()),
            'total' => $especificaciones->total(),
            'success' => true,
            'message' => 'Especificaciones recuperados correctamente'
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
    public function store(StoreEspecificacionRequest $request)
    {
        $especificacion = $this->service->crearEspecificacion($request->validated());
        return response()->json(new EspecificacionResource($especificacion), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Especificacion $especificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especificacion $especificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEspecificacionRequest $request, Especificacion $especificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especificacion $especificacion)
    {
        //
    }
}
