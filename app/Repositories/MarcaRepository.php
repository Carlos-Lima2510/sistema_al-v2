<?php

namespace App\Repositories;

use App\Models\Marca;

class MarcaRepository
{
    public function getAll()
    {
        return Marca::all();
    }

    public function findById($id)
    {
        return Marca::findOrFail($id);
    }

    public function create(array $data)
    {
        return Marca::create($data);
    }
}
