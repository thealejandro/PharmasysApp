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
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Grocer']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Seller']);
        Role::create(['name' => 'Accountant']);
        Role::create(['name' => 'Support']);
        Role::create(['name' => 'Tester']);
        Role::create(['name' => 'Baned']);
        $roleVerify = Role::create(['name' => 'Verified']);
        $role3 = Role::create(['name' => 'Super-Admin']);

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
