<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoVentaRequest;
use App\Http\Requests\UpdatePedidoVentaRequest;
use App\Models\PedidoVenta;
use App\Services\PedidoVentaService;
use App\Http\Resources\PedidoVentaResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PedidoVentaController extends Controller
{
    protected $service;

    public function __construct(PedidoVentaService $service)
    {
        $this->middleware('can:ver pedidos')->only(['index', 'show']);
        $this->middleware('can:crear pedidos')->only(['store', 'create']);
        $this->middleware('can:editar pedidos')->only(['update', 'edit']);
        $this->middleware('can:eliminar pedidos')->only(['destroy']);

        $this->service = $service;
    }
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $pedidos = $this->service->listarPedidosDeVenta($perPage);

        return response()->json([
            'data' => PedidoVentaResource::collection($pedidos->items()),
            'total' => $pedidos->total(),
            'success' => true,
            'message' => 'Pedidos recuperados correctamente'
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
    public function store(StorePedidoVentaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoVenta $pedidoVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoVenta $pedidoVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoVentaRequest $request, PedidoVenta $pedidoVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoVenta $pedidoVenta)
    {
        //
    }
}
