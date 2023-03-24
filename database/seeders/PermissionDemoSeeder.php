<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superadminRole = Role::create(['name' => 'super-admin']);

        $user = User::factory()->create([
            'name' => 'admin_super',
            'email' => 'admin_super@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        $user->assignRole($superadminRole);
    }
}
