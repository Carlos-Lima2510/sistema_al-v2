<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianteEspecificacion extends Model
{
    protected $table = 'variante_especificaciones';

    protected $primaryKey = 'id_variante_especificaciones';
    public $timestamps = true;

    protected $fillable = [
        'id_variantes',
        'id_especificacion',
        'valor',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function especificacion()
    {
        return $this->belongsTo(Especificacion::class, 'id_especificacion');
    }

    public function variante()
    {
        return $this->belongsTo(Variante::class, 'id_variantes');
    }
}

