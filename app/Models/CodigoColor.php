<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodigoColor extends Model
{
    /** @use HasFactory<\Database\Factories\CodigoColorFactory> */
    use HasFactory;

    protected $table = 'codigo_color';
    protected $primaryKey = 'id_codigo_color';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre_color',
        'id_marca_material'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function marcaMaterial(): BelongsTo
    {
        return $this->belongsTo(MarcaMaterial::class, 'id_marca_material');
    }

}
