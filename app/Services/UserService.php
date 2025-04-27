<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listarUsuarios()
    {
        return $this->repo->getAll();
    }

    public function mostrarUsuario($id)
    {
        return $this->repo->getById($id);
    }

    public function crearUsuarios(array $data)
    {
        return $this->repo->create($data);
    }
}
