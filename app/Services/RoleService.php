<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleService
{
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function asignarRol(User $usuario, $rolNombre)
    {
        if (!$this->roleRepo->rolExiste($rolNombre)) {
            throw ValidationException::withMessages([
                'rol' => 'El rol proporcionado no existe.'
            ]);
        }

        $usuario->assignRole($rolNombre);

        return $usuario;
    }
}
