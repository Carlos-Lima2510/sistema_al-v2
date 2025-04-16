<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMaterialFactory> */
    use HasFactory;

    protected $table = 'tipo_material';
    protected $primary_key = 'id_material';
    public $timestamps = true;

    protected $fillable = [
        'nombre_material',
        'descripcion'
    ];
}
