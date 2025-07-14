<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCodigoColorRequest;
use App\Models\CodigoColor;
use App\Http\Resources\CodigoColorResource;
use App\Services\CodigoColorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CodigoColorController extends Controller
{
    protected $service;

    public function __construct(CodigoColorService $service)
    {
        $this->middleware('can:ver colores')->only(['index', 'show']);
        $this->middleware('can:crear colores')->only(['store', 'create']);
        $this->middleware('can:editar colores')->only(['update', 'edit']);
        $this->middleware('can:eliminar colores')->only(['destroy']);

        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $colores = $this->service->listarCodigosColor($perPage);

        return response()->json([
            'data' => CodigoColorResource::collection($colores->items()),
            'total' => $colores->total(),
            'success' => true,
            'message' => 'Codigos de colores recuperados correctamente'
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
    public function store(StoreCodigoColorRequest $request)
    {
        $color = $this->service->crear($request->validated());
        return new CodigoColorResource($color);
    }

    /**
     * Display the specified resource.
     */
    public function show(CodigoColor $codigoColor)
    {
        $color = $this->service->obtenerCodigoColor($codigoColor->id_codigo_color);
        return new CodigoColorResource($color);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodigoColor $codigoColor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CodigoColor $codigoColor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodigoColor $codigoColor)
    {
        //
    }
}
