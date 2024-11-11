<?php

namespace Database\Seeders;

use App\Models\MesesCantidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = Role::create(['name' => 'Administrador']);
        $moderador = Role::create(['name' => 'Moderador']);
        $huesped = Role::create(['name' => 'Huesped']);

        Permission::create(['name' => 'habitacionesEstado'])->syncRoles([$admin, $moderador]);
        Permission::create(['name' => 'huesped'])->syncRoles([$admin, $moderador]);
        Permission::create(['name' => 'reservas'])->syncRoles([$admin, $moderador]);
        Permission::create(['name' => 'recibos'])->syncRoles([$admin, $moderador]);
        Permission::create(['name' => 'sedes'])->assignRole($admin);
        Permission::create(['name' => 'habitaciones'])->assignRole($admin);
        Permission::create(['name' => 'moderadores'])->assignRole($admin);
        Permission::create(['name' => 'administradores'])->assignRole($admin);
        Permission::create(['name' => 'reservashuesped'])->assignRole($huesped);
        Permission::create(['name' => 'misRecibos'])->assignRole($huesped);

        User::factory()->create([
            'name' => 'admin',
            'apellido' => 'jose',
            'identificacion' => '22222233',
            'telefono' => '0415552222',
            'email' => 'admin@example.com',
            'password' => Hash::make('12121212'),
            'tipo' => 'Administrador',
        ])->assignRole('Administrador');

    }
}
