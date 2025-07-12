<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especificacion extends Model
{
    /** @use HasFactory<\Database\Factories\EspecificacionFactory> */
    use HasFactory;

    protected $table = 'especificaciones';
    protected $primaryKey = 'id_especificaciones';
    public $timestamps = true;

    protected $fillable = [
        'nombre_especificacion',
        'unidad'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function variantes()
    {
        return $this->hasMany(VarianteEspecificacion::class, 'id_especificaciones');
    }
}
