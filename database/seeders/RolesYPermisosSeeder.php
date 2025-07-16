<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesYPermisosSeeder extends Seeder
{
    public function run()
    {
        // Reset cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos para productos
        $permisos = [
            'ver productos',
            'crear productos',
            'editar productos',
            'eliminar productos',
            'ver categorias',
            'crear categorias',
            'editar categorias',
            'eliminar categorias',
            'ver materiales',
            'crear materiales',
            'editar materiales',
            'eliminar materiales',
            'ver pedidos',
            'crear pedidos',
            'editar pedidos',
            'eliminar pedidos',
            'ver especificaciones',
            'crear especificaciones',
            'editar especificaciones',
            'eliminar especificaciones',
            'ver marcas',
            'crear marcas',
            'editar marcas',
            'eliminar marcas',
            'ver colores',
            'crear colores',
            'editar colores',
            'eliminar colores',
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver roles',
            'crear roles',
            'asignar roles',
            'editar roles',
            'eliminar roles',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $usuario = Role::firstOrCreate(['name' => 'usuario']);

        // Asignar permisos a roles
        $admin->syncPermissions(Permission::all());

        $usuario->syncPermissions([
            'ver productos',
            'crear productos',
            'editar productos',
            'ver materiales',
            'crear materiales',
            'editar materiales',
            'ver categorias',
            'crear categorias',
            'ver marcas',
            'crear marcas',
            'editar marcas',
            'ver colores',
            'crear colores',
            'editar colores',
            'eliminar colores'
        ]);

        $user = User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('password')]);
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
