<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = true;
    protected $fillable = [
        'id_categoria',
        'id_marca_material',
        'id_codigo_color',
        'costo_base',
        'activo',
        'descripcion',
        'fecha_registro'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function marcaMaterial(): BelongsTo
    {
        return $this->belongsTo(MarcaMaterial::class, 'id_marca_material');
    }

    public function codigoColor(): BelongsTo
    {
        return $this->belongsTo(CodigoColor::class, 'id_codigo_color');
    }

    public function variantes()
    {
        return $this->hasMany(Variante::class, 'id_producto', 'id_producto');
    }
}
