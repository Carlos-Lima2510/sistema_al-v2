<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PedidoVenta extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoVentaFactory> */
    use HasFactory;

    protected $table = 'pedido_ventas';

    protected $primaryKey = 'id_pedido_venta';
    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'fecha_pedido',
        'metodo_pago',
        'estado',
        'total',
        'observaciones'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
