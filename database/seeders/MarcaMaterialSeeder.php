<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MarcaMaterial;
use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relationships = [
            1 => [3],
            2 => [2, 3],
            3 => [2, 3],
            4 => [3],
            5 => [4],
            6 => [2],
            7 => [1, 2],
        ];

        foreach ($relationships as $marcaId => $materialIds) {
            $marca = Marca::find($marcaId);

            if ($marca) {
                // Eliminar relaciones existentes primero
                MarcaMaterial::where('id_marca', $marcaId)->delete();
                
                // Crear nuevas relaciones
                foreach ($materialIds as $materialId) {
                    MarcaMaterial::create([
                        'id_marca' => $marcaId,
                        'id_tipo_material' => $materialId
                    ]);
                }
            }
        }
    }
}
