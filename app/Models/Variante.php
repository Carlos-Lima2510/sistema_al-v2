<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variante extends Model
{
    protected $table = 'variantes';
    protected $primaryKey = 'id_variantes';
    public $timestamps = true;
    protected $fillable = [
        'id_producto',
        'precio_unitario',
        'precio_por_mayor',
        'stock'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function especificaciones()
    {
        return $this->belongsToMany(
            Especificacion::class,
            'variante_especificaciones',
            'id_variantes',
            'id_especificaciones'
        )->withPivot('valor');
    }
}
