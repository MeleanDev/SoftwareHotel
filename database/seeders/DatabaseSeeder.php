<?php

namespace Database\Seeders;

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

        Permission::create(['name' => 'administrador'])->assignRole($admin);
        Permission::create(['name' => 'moderador'])->assignRole($moderador);
        Permission::create(['name' => 'huesped'])->assignRole($huesped);

        User::factory()->create([
            'name' => 'luis',
            'apellido' => 'jose',
            'identificacion' => '301399282',
            'telefono' => '04122222222',
            'email' => 'admin@example.com',
            'password' => Hash::make('12121212')
        ])->assignRole('Administrador');

    }
}
