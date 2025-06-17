<?php

namespace App\Repositories;

use App\Models\CodigoColor;

class CodigoColorRepository
{
    public function getAll()
    {
        return CodigoColor::all();
    }

    public function getCodigoColor($id)
    {
        return CodigoColor::findOrFail($id);
    }

    public function createCodigoColor($data)
    {
        return CodigoColor::create($data);
    }
}
