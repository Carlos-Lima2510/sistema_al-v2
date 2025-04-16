<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoColor extends Model
{
    /** @use HasFactory<\Database\Factories\CodigoColorFactory> */
    use HasFactory;

    protected $table = 'codigo_color';
    protected $primary_key = 'id_codigo_color';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre_color',
        'id_marca_material'
    ];

}
