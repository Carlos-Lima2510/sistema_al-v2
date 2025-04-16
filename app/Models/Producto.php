<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $table = 'producto';

    protected $primary_key = 'id_producto';

    protected $fillable = [
        'categoria',
        'id_marca_material',
        'id_codigo_color',
        'precio_unitario',
        'precio_mayoreo',
        'stock',
        'descripcion',
        'fecha_registro',
        'activo'
    ];
}
