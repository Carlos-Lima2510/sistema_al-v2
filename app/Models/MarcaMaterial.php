<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MarcaMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\MarcaMaterialFactory> */
    use HasFactory;

    protected $table = 'marca_material';

    protected $primaryKey = 'id_marca_material';
    public $timestamps = true;

    protected $fillable = [
        'id_marca',
        'id_tipo_material'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_marca_material');
    }

    public function codigoColores(): HasMany
    {
        return $this->hasMany(CodigoColor::class,'id_marca_material');
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function tipo_material(): BelongsTo
    {
        return $this->belongsTo(TipoMaterial::class,'id_tipo_material');
    }
}
