<?php

namespace Database\Seeders;

use App\Models\Managers;
use App\Models\Sellers;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Session\Store;
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
        $admin      = Role::create(['name' => 'Administrator']);  //Rol de Administrador
        $grocer     = Role::create(['name' => 'Grocer']);         //Rol de Bodeguero
        $manager    = Role::create(['name' => 'Manager']);        //Rol de Gerente de tienda
        $seller     = Role::create(['name' => 'Seller']);         //Rol de Vendedor
        $accountant = Role::create(['name' => 'Accountant']);     //Rol de Contador
        $support    = Role::create(['name' => 'Support']);        //Rol de Soporte
        $tester     = Role::create(['name' => 'Tester']);         //Rol de Tester
        $baned      = Role::create(['name' => 'Baned']);          //Rol de Baneado (Usuarios desactivados)
        $verified   = Role::create(['name' => 'Verified']); //Rol de Verificado (Usuarios activos y aprobados)
        $root       = Role::create(['name' => 'Super-Admin']);   //Rol de Root del Sistema, todos los privilegios aprobados

        // create user for Super-Admin
        $user = User::factory()->create([
            'userID' => 0,
            'username' => 'Developer',
            'first_name' => 'Developer',
            'last_name' => null,
            'email' => 'developer@pharmasys.com',
            'password' => Hash::make('r00tp@sS'),
        ]);
        $user->assignRole($root);
        $user->assignRole($verified);

        // Create User's for system Pharmasys
        $baldo  = User::factory()->create(['userID' => 1, 'username' => 'balcore', 'first_name' => 'Baldomero', 'last_name' => 'Quej', 'email' => 'baldcore@pharmasys.com', 'password' => Hash::make('password')]);
        $daniel = User::factory()->create(['userID' => 2, 'username' => 'daniel', 'first_name' => 'Daniel', 'last_name' => 'Herrarte', 'email' => 'daniel@pharmasys.com', 'password' => Hash::make('Kirax1194')]);
        $blanca = User::factory()->create(['userID' => 3, 'username' => 'blanca', 'first_name' => 'Blanca', 'last_name' => 'Johnston', 'email' => 'blanca@pharmasys.com', 'password' => Hash::make('abraham')]);
        $rigo   = User::factory()->create(['userID' => 4, 'username' => 'rigo', 'first_name' => 'Rigo', 'last_name' => NULL, 'email' => 'rigo@pharmasys.com', 'password' => Hash::make('sipriano')]);
        $karin  = User::factory()->create(['userID' => 5, 'username' => 'karin', 'first_name' => 'Karin', 'last_name' => NULL, 'email' => 'karin@pharmasys', 'password' => Hash::make('938475984375')]);
        $eulalia = User::factory()->create(['userID' => 6,'username' => 'eulalia', 'first_name' => 'Eulalia', 'last_name' => NULL, 'email' => 'eulalia@pharmasys.com', 'password' => Hash::make('4905')]);
        $odilia = User::factory()->create(['userID' => 7,'username' => 'odilia', 'first_name' => 'Odilia', 'last_name' => 'Ventura', 'email' => 'odilia@pharmasys.com', 'password' => Hash::make('5158')]);
        $raul   = User::factory()->create(['userID' => 8,'username' => 'raul', 'first_name' => 'Raul', 'last_name' => NULL, 'email' => 'raul@pharmasys.com', 'password' => Hash::make('2sd4fds')]);
        $rosmey = User::factory()->create(['userID' => 9,'username' => 'rosmey', 'first_name' => 'Rosmey', 'last_name' => NULL, 'email' => 'rosmey@pharmasys.com', 'password' => Hash::make('65654')]);
        $celia  = User::factory()->create(['userID' => 10,'username' => 'celia', 'first_name' => 'Celia', 'last_name' => NULL, 'email' => 'celia@pharmasys.com', 'password' => Hash::make('1234')]);

        $baldo->assignRole($baned);
        $baldo->delete();

        $daniel->assignRole($admin);
        $daniel->assignRole($verified);

        $blanca->assignRole($admin);
        $blanca->assignRole($verified);

        $rigo->assignRole($seller);
        $rigo->assignRole($manager);
        $rigo->assignRole($verified);

        $karin->assignRole($baned);
        $karin->delete();

        $eulalia->assignRole($seller);
        $eulalia->assignRole($manager);
        $eulalia->assignRole($verified);

        $odilia->assignRole($seller);
        $odilia->assignRole($manager);
        $odilia->assignRole($verified);

        $raul->assignRole($baned);
        $raul->delete();

        $rosmey->assignRole($baned);
        $rosmey->delete();

        $celia->assignRole($seller);
        $celia->assignRole($manager);
        $celia->assignRole($verified);

        // Create list Manager's
        $managerProbgam = Managers::create(['user_id' => $odilia->id, 'user_approve_id' => $daniel->id]);
        $managerComunal = Managers::create(['user_id' => $eulalia->id, 'user_approve_id' => $daniel->id]);
        $managerFarco   = Managers::create(['user_id' => $rigo->id, 'user_approve_id' => $daniel->id]);
        $managerProbgam2 = Managers::create(['user_id' => $celia->id, 'user_approve_id' => $daniel->id]);

        // Create store's
        $probgam    = Stores::create(['storeID' => 2, 'name' => 'Probgam', 'manager_id' => $managerProbgam->id]);
        $comunal    = Stores::create(['storeID' => 3, 'name' => 'Comunal', 'manager_id' => $managerComunal->id]);
        $farco      = Stores::create(['storeID' => 4, 'name' => 'Farco', 'manager_id' => $managerFarco->id]);
        $probgam2   = Stores::create(['storeID' => 5, 'name' => 'Probgam 2', 'manager_id' => $managerProbgam2->id]);

        // Create seller's
        Sellers::create(['user_id' => $odilia->id, 'store_id' => $probgam->storeID]);
        Sellers::create(['user_id' => $eulalia->id, 'store_id' => $comunal->storeID]);
        Sellers::create(['user_id' => $rigo->id, 'store_id' => $farco->storeID]);
        Sellers::create(['user_id' => $celia->id, 'store_id' => $probgam2->storeID]);
    }
}
