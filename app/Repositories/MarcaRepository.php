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
        return Marca::find($id);
    }

    public function exists($id)
    {
        return Marca::where("id_marca", $id)->exists();
    }

    public function create(array $data)
    {
        return Marca::create($data);
    }
}
