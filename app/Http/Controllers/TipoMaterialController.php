<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoMaterialRequest;
use App\Http\Resources\TipoMaterialCollection;
use App\Models\TipoMaterial;
use App\Services\TipoMaterialService;
use App\Http\Resources\TipoMaterialResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TipoMaterialController extends Controller
{
    protected $service;

    public function __construct(TipoMaterialService $service)
    {
        $this->middleware('can:ver materiales')->only(['index', 'show']);
        $this->middleware('can:crear materiales')->only(['store', 'create']);
        $this->middleware('can:editar materiales')->only(['update', 'edit']);
        $this->middleware('can:eliminar materiales')->only(['destroy']);

        $this->service = $service;
    }
    
    public function index()
    {
        $materiales = $this->service->listarMateriales();
        return new TipoMaterialCollection($materiales);
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
    public function store(StoreTipoMaterialRequest $request)
    {
        $material = $this->service->crear($request->validated());
        return response()->json(new TipoMaterialResource($material), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_tipo_material)
    {
        $material = $this->service->getMaterial($id_tipo_material);
        return response()->json(new TipoMaterialResource($material),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoMaterial $tipoMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoMaterial $tipoMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoMaterial $tipoMaterial)
    {
        //
    }
}
