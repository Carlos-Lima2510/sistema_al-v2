<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver marcas')->only(['index', 'show']);
        $this->middleware('can:crear marcas')->only(['store', 'create']);
        $this->middleware('can:editar marcas')->only(['update', 'edit']);
        $this->middleware('can:eliminar marcas')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marca::all();
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
    public function store(Request $request)
    {
        return Marca::create($request->only(
            'nombre_marca'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return Marca::findOrFail($marca->id_marca);
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
