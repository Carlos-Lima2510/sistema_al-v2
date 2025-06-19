<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAsignarRolRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserAsignarRolResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $service;
    protected $roleService;

    public function __construct(UserService $service, RoleService $roleService)
    {
        $this->middleware('can:ver usuarios')->only(['index', 'show']);
        $this->middleware('can:asignar roles')->only(['asignarRol']);
        $this->middleware('can:crear usuarios')->only(['store', 'create']);
        $this->middleware('can:editar usuarios')->only(['update', 'edit']);
        $this->middleware('can:eliminar usuarios')->only(['destroy']);

        $this->service = $service;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $usuarios = $this->service->listarUsuarios();
        return new UserCollection($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function asignarRol(UserAsignarRolRequest $request, User $usuario)
    {
        $rol = $request->validated();

        $usuario = $this->roleService->asignarRol($usuario, $rol);
        return new UserAsignarRolResource($usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $usuario = $this->service->crearUsuarios($request->validated());
        return response()->json(new UserResource($usuario), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
