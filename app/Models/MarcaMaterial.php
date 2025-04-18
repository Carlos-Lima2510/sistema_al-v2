<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\MarcaMaterialFactory> */
    use HasFactory;

    protected $table = 'marca_material';

    protected $primary_key = 'id_marca_material';

    protected $fillable = [
        'id_marca',
        'id_tipo_material'
    ];
}
