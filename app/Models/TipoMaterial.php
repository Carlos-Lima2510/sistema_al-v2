<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TipoMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMaterialFactory> */
    use HasFactory;

    protected $table = 'tipo_material';
    protected $primaryKey = 'id_tipo_material';
    public $timestamps = true;

    protected $fillable = [
        'nombre_material',
        'descripcion'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function marcaMateriales(): HasMany
    {
        return $this->hasMany(MarcaMaterial::class, 'id_tipo_material');
    }

    public function marcas(): HasManyThrough
    {
        return $this->hasManyThrough(
            Marca::class,
            MarcaMaterial::class,
            'id_tipo_material',
            'id_marca',
            'id_tipo_material',
            'id_marca'
        );
    }

}
