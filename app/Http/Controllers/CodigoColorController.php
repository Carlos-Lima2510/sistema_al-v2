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

    public function index()
    {
        $colores = $this->service->listarCodigosColor();
        return CodigoColorResource::collection($colores);
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
        //
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
