<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign existing permissions
        Role::create(['name' => 'Administrator']);  //Rol de Administrador
        Role::create(['name' => 'Grocer']);         //Rol de Bodeguero
        Role::create(['name' => 'Manager']);        //Rol de Gerente de tienda
        Role::create(['name' => 'Seller']);         //Rol de Vendedor
        Role::create(['name' => 'Accountant']);     //Rol de Contador
        Role::create(['name' => 'Support']);        //Rol de Soporte
        Role::create(['name' => 'Tester']);         //Rol de Tester
        Role::create(['name' => 'Baned']);          //Rol de Baneado (Usuarios desactivados)
        $roleVerify = Role::create(['name' => 'Verified']); //Rol de Verificado (Usuarios activos y aprobados)
        $role3 = Role::create(['name' => 'Super-Admin']);   //Rol de Root del Sistema, todos los privilegios aprobados

        // create user for Super-Admin
        $user = User::factory()->create([
            'username' => 'Developer',
            'first_name' => 'Developer',
            'last_name' => null,
            'email' => 'developer@pharmasys.com',
            'password' => Hash::make('r00tp@sS'),
        ]);
        $user->assignRole($role3);
        $user->assignRole($roleVerify);
    }
}
