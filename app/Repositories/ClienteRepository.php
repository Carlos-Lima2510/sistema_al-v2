<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Cliente::paginate($perPage);
    }

    public function getById($id)
    {
        return Cliente::findOrFail($id);
    }

    public function createCliente(array $data)
    {
        return Cliente::create($data);
    }
}
