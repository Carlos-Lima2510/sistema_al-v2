<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolesYPermisosSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(TipoMaterialSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MarcaMaterialSeeder::class);

    }
}
