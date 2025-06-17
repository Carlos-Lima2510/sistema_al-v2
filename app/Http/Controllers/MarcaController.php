<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Http\Resources\MarcaResource;
use App\Models\Marca;
use App\Services\MarcaService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
{
    protected $service;
    public function __construct(MarcaService $service)
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
        $marcas = $this->service->listarMarcas();
        return MarcaResource::collection($marcas);
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
    public function store(StoreMarcaRequest $request)
    {
        DB::beginTransaction();
        try {
            $marca = $this->service->crearMarca($request->validated());
            DB::commit();
            return response()->json(new MarcaResource($marca), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        $marca = $this->service->getMarca($marca->id_marca);
        return new MarcaResource($marca);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        //
    }
}
