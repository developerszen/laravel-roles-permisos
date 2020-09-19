<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_admin = Role::create([ 'name' => 'admin']);
        $role_editor = Role::create([ 'name' => 'editor']);
        $role_writer = Role::create([ 'name' => 'writer']);
        Role::create([ 'name' => 'super-admin']);

        $permissions = collect([
            'write post',
            'view unpublished posts',
            'edit all posts',
            'update all posts',
            'can delete post',
            'publish post',
            'unpublish post',
            'register user',
            'disable user',
            'edit all user',
        ]);

        $permissions_by_role = [
            'admin' => [
                'write post',
                'view unpublished posts',
                'edit all posts',
                'update all posts',
                'can delete post',
                'register user',
                'disable user',
                'edit all user',
            ],
            'editor' => [
                'view unpublished posts',
                'can delete post',
                'publish post',
                'unpublish post',
            ],
            'writer' => [
                'write post',
            ],
        ];

        $permissions = $permissions->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $role_admin->syncPermissions($permissions_by_role['admin']);
        $role_editor->syncPermissions($permissions_by_role['editor']);
        $role_writer->syncPermissions($permissions_by_role['writer']);

    }
}
