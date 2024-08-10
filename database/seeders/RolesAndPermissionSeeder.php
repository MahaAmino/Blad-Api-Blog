<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// Reset cached roles and permissions
/* app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions(); */
// create permissions
/* Permission::create(['name' => 'delete posts']);
Permission::create(['name' => 'assign roles']);
Permission::create(['name' => 'manage roles']);
Permission::create(['name' => 'create posts']);
Permission::create(['name' => 'edit posts']); */
// create roles and assign existing permissions
/* $role = Role::create(['name' => 'admin']);
$role->givePermissionTo(['delete posts', 'assign roles', 'manage roles']);
$role = Role::create(['name' => 'editor']);
$role->givePermissionTo(['delete posts', 'create posts', 'edit posts']);
Role::create(['name' => 'user']); */
    }
}
