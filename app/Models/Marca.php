<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    /** @use HasFactory<\Database\Factories\MarcaFactory> */
    use HasFactory;

    protected $table = 'marca';
    protected $primaryKey = 'id_marca';
    public $timestamps = true;

    protected $fillable = [
        'nombre_marca'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function marcaMateriales(): HasMany
    {
        return $this->hasMany(MarcaMaterial::class, 'id_marca');
    }

    public function tipoMateriales(): HasManyThrough
    {
        return $this->hasManyThrough(TipoMaterial::class, MarcaMaterial::class,'id_marca','id_tipo_material');
    }
    
}
