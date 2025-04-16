<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /** @use HasFactory<\Database\Factories\MarcaFactory> */
    use HasFactory;

    protected $table = 'marca';
    protected $primary_key = 'id_marca';
    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];
    
}
