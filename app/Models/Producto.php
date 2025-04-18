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
        'id_categoria',
        'id_marca_material',
        'id_codigo_color',
        'precio_unitario',
        'precio_mayoreo',
        'activo',
        'descripcion',
        'stock',
        'fecha_registro'
    ];
}
