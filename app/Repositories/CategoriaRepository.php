<?php

namespace App\Repositories;

use \App\Models\Categoria;

class CategoriaRepository
{
    public function getAll()
    {
        return Categoria::all();
    }

    public function getById($id)
    {
        return Categoria::findOrFail($id);
    }

    public function create($array){
        return Categoria::create($array);
    }
}
