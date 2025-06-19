<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'DMC',
            'Anchor',
            'Iris',
            'Esmeralda',
            'Omega',
            'Pavo Real',
            'ICEA'
        ];

        foreach ($brands as $brand) {
            Marca::firstOrCreate(['nombre_marca' => $brand]);
        }
    }
}
