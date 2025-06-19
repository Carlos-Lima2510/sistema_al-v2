<?php

namespace Database\Seeders;

use App\Models\TipoMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = [
            'Lana',
            'Sedalana',
            'Lustrina',
            'Bricho'
        ];

        foreach ($materiales as $material){
            TipoMaterial::firstOrCreate(['nombre_material' => $material]);
        }
    }
}
