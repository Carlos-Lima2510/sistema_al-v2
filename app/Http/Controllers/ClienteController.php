<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Routing\Controller;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
{
    protected $service;

    public function __construct(ClienteService $service)
    {
        $this->middleware('can:ver usuarios')->only(['index', 'show']);
        $this->middleware('can:crear usuarios')->only(['store', 'create']);
        $this->middleware('can:editar usuarios')->only(['update', 'edit']);
        $this->middleware('can:eliminar usuarios')->only(['destroy']);

        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $clientes = $this->service->listarClientes($perPage);

        return response()->json([
            'data' => ClienteResource::collection($clientes->items()),
            'total' => $clientes->total(),
            'success' => true,
            'message' => 'Clientes recuperados correctamente'
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
    public function store(StoreClienteRequest $request)
    {
        $cliente = $this->service->crear($request->validated());
        return new ClienteResource($cliente);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = $this->service->obtenerPorId($id);
        return new ClienteResource($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
