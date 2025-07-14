<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\CodigoColorFactory> */
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;

    protected $fillable = [
        'nombre_cliente',
        'email',
        'telefono',
        'direccion',
        'numero_identificacion',
        'tipo_cliente',
        'notas'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function pedidoVenta(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_cliente');
    }
}
