<?php

namespace Database\Seeders;

use App\Enums\Permission;
use Codestage\Authorization\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::query()->firstOrCreate([
            'key' => 'admin',
            'name' => 'Administrator'
        ]);

        $user = Role::query()->firstOrCreate(
            [
                'key' => 'user',
                'name' => 'Utilizator',
            ]
        );

        foreach ( Permission::cases() as $permission) {
            $admin->permissions()->firstOrCreate([
                'permission' => $permission,
            ]);
        }

        foreach([
            Permission::ViewUserDashboard,
        ] as $permission) {
            $user->permissions()->firstOrCreate([
                'permission' => $permission
            ]);
        }
    }
}
