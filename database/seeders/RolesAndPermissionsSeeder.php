<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'manage users',
            'manage players',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $role_admin = Role::firstOrCreate(['name' => 'admin']);
        $role_admin->syncPermissions(Permission::all());

        $role_viewer = Role::firstOrCreate(['name' => 'coach']);
        $role_viewer->givePermissionTo('view posts');

        $user = User::firstOrCreate(
            [
                'email' => 'admin@santaana.com'
            ],
            [
                'name' => 'Admin Santaana',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($role_admin);
    }
}
