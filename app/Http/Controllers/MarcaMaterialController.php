<?php

namespace App\Http\Controllers;

use App\Models\MarcaMaterial;
use Illuminate\Http\Request;

class MarcaMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcaMaterials = MarcaMaterial::all();
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
        //
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
