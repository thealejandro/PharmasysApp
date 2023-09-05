<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ManagerAssignments;
use App\Models\Sellers;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DefaultDataConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached Roles and Permissions
        // app()[PermissionRegistrar::class]->forgetCachePermissions();

        // Create Roles and assign existing permissions
        $admin      = Role::create(['name' => 'Administrator']);  //Rol de Administrador
        $grocer     = Role::create(['name' => 'Grocer']);         //Rol de Bodeguero
        $manager    = Role::create(['name' => 'Manager']);        //Rol de Gerente de tienda
        $seller     = Role::create(['name' => 'Seller']);         //Rol de Vendedor
        $accountant = Role::create(['name' => 'Accountant']);     //Rol de Contador
        $support    = Role::create(['name' => 'Support']);        //Rol de Soporte
        $tester     = Role::create(['name' => 'Tester']);         //Rol de Tester
        $baned      = Role::create(['name' => 'Banned']);          //Rol de Baneado (Usuarios desactivados)
        $verified   = Role::create(['name' => 'Verified']); //Rol de Verificado (Usuarios activos y aprobados)
        $root       = Role::create(['name' => 'Root']);   //Rol de Root del Sistema, todos los privilegios aprobados

        // create user for Super-Admin
        $user = User::create([
            'username' => 'root',
            'first_name' => 'Root',
            'last_name' => null,
            'email' => 'root@pharmasys.com',
            'password' => Hash::make('r00tp@sS'),
        ]);
        $user->assignRole($root);
        $user->assignRole($verified);

        // Create User's for system Pharmasys
        // $daniel = User::create(['username' => 'daniel', 'first_name' => 'Daniel', 'last_name' => 'Herrarte', 'email' => 'daniel@pharmasys.com', 'password' => Hash::make('Kirax1194')]);
        $daniel = User::create(['username' => 'admin', 'first_name' => 'Admin', 'last_name' => NULL, 'email' => 'admin@pharmasys.com', 'password' => Hash::make('admin')]);
        $blanca = User::create(['username' => 'blanca', 'first_name' => 'Blanca', 'last_name' => 'Johnston', 'email' => 'blanca@pharmasys.com', 'password' => Hash::make('abraham')]);
        $rigo   = User::create(['username' => 'rigo', 'first_name' => 'Rigo', 'last_name' => NULL, 'email' => 'rigo@pharmasys.com', 'password' => Hash::make('sipriano')]);
        $vicente = User::create(['username' => 'vicente', 'first_name' => 'Vicente', 'last_name' => NULL, 'email' => 'vicente@pharmasys.com', 'password' => Hash::make('4905')]);
        $odilia = User::create(['username' => 'odilia', 'first_name' => 'Odilia', 'last_name' => 'Ventura', 'email' => 'odilia@pharmasys.com', 'password' => Hash::make('5158')]);
        $victoria  = User::create(['username' => 'victoria', 'first_name' => 'Victoria', 'last_name' => NULL, 'email' => 'victoria@pharmasys.com', 'password' => Hash::make('1234')]);

        $daniel->assignRole($admin);
        $daniel->assignRole($verified);

        $blanca->assignRole($admin);
        $blanca->assignRole($verified);

        $rigo->assignRole($seller);
        $rigo->assignRole($manager);
        $rigo->assignRole($verified);

        $vicente->assignRole($seller);
        $vicente->assignRole($manager);
        $vicente->assignRole($verified);

        $odilia->assignRole($seller);
        $odilia->assignRole($manager);
        $odilia->assignRole($verified);

        $victoria->assignRole($seller);
        $victoria->assignRole($manager);
        $victoria->assignRole($verified);

        // Create list Manager's
        $managerProbgam = ManagerAssignments::create(['user_id' => $odilia->id, 'user_approve_id' => $daniel->id]);
        $managerComunal = ManagerAssignments::create(['user_id' => $vicente->id, 'user_approve_id' => $daniel->id]);
        $managerFarco   = ManagerAssignments::create(['user_id' => $rigo->id, 'user_approve_id' => $daniel->id]);
        $managerProbgam2 = ManagerAssignments::create(['user_id' => $victoria->id, 'user_approve_id' => $daniel->id]);

        // Create store's
        $probgam    = Stores::create(['name' => 'Probgam', 'manager_id' => $managerProbgam->id, 'store_code' => 1, 'store_name' => "PROBGAM", 'store_direction' => "6 AVENIDA 6-088 Zona 11", 'store_municipality' => "COBAN", 'store_department' => "ALTA VERAPAZ", 'store_phone' => 0, 'status_active' => true]);
        $comunal    = Stores::create(['name' => 'Comunal', 'manager_id' => $managerComunal->id, 'store_code' => 2,'store_name' =>"FARMACIA COMUNAL", 'store_direction' => "2 AVENIDA 6-092 Zona 1",'store_municipality' => "COBAN", 'store_department' => "ALTA VERAPAZ", 'store_phone' => 0, 'status_active' => true]);
        $farco      = Stores::create(['name' => 'Farco', 'manager_id' => $managerFarco->id, 'store_code' => 3,'store_name' => "FARCO", 'store_direction' => "1 AVENIDA 03-38 Zona 1", 'store_municipality' => "COBAN", 'store_department' => "ALTA VERAPAZ", 'store_phone' => 0, 'status_active' => true]);
        $probgam2   = Stores::create(['name' => 'Probgam 2', 'manager_id' => $managerProbgam2->id, 'store_code' => 5,'store_name' => "FARMACIA PROBGAM II", 'store_direction' => "1 AVENIDA 3-46 Zona 1", 'store_municipality' => "COBAN", 'store_department' => "ALTA VERAPAZ", 'store_phone' => 0, 'status_active' => true]);

        // Create seller's
        Sellers::create(['user_id' => $odilia->id, 'store_id' => $probgam->id]);
        Sellers::create(['user_id' => $vicente->id, 'store_id' => $comunal->id]);
        Sellers::create(['user_id' => $rigo->id, 'store_id' => $farco->id]);
        Sellers::create(['user_id' => $victoria->id, 'store_id' => $probgam2->id]);
    }
}
