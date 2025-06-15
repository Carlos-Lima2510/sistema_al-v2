<?php

namespace App\Http\Controllers;

use App\Models\MarcaMaterial;
use App\Services\MarcaMaterialService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MarcaMaterialController extends Controller
{
    protected $service;

    public function __construct(MarcaMaterialService $service)
    {
        $this->middleware('can:ver marcas')->only(['index', 'show']);
        $this->middleware('can:crear marcas')->only(['store', 'create']);
        $this->middleware('can:editar marcas')->only(['update', 'edit']);
        $this->middleware('can:eliminar marcas')->only(['destroy']);

        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcaMaterial = $this->service->listarMarcaMaterial();
        return response()->json($marcaMaterial);
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
        $marcaMaterial = $this->service->crearMarcaMaterial($request->all());
        return response()->json($marcaMaterial, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MarcaMaterial $marcaMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarcaMaterial $marcaMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarcaMaterial $marcaMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarcaMaterial $marcaMaterial)
    {
        //
    }
}
