<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoEspecificacion extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoEspecificacionFactory> */
    use HasFactory;

    protected $table = 'id_producto_especificacion';
    protected $primary_key = 'id_producto_especificacion';
    protected $fillable = [
        'id_producto',
        'id_tipo_especificacion',
        'valor_numero',
        'valor_texto',
        'valor_booleano'
    ];

}
