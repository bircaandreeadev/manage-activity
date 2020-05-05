<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions for users
        Permission::create(['name' => 'manage users']);

        // permissions for tasks
        Permission::create(['name' => 'add own task']);
        Permission::create(['name' => 'view own task']);
        Permission::create(['name' => 'delete own task']);
        Permission::create(['name' => 'manage own tasks']);
        Permission::create(['name' => 'manage tasks']);

        // permissions for projects
        Permission::create(['name' => 'view project']);
        Permission::create(['name' => 'manage projects']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['view own task', 'delete own task', 'manage own tasks', 'add own task', 'view project']);

    }
}
