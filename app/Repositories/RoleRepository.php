<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function rolExiste($rolNombre)
    {
        return Role::where('name', $rolNombre)->exists();
    }
}
