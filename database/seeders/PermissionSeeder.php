<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            PermissionName::VIEW_USER,
            PermissionName::CREATE_USER,
            PermissionName::UPDATE_USER,
            PermissionName::DELETE_USER,
            PermissionName::RESTORE_USER,
           

            PermissionName::VIEW_COURSE,
            PermissionName::CREATE_COURSE,
            PermissionName::UPDATE_COURSE,
            PermissionName::DELETE_COURSE,
            PermissionName::RESTORE_COURSE,
        ];

        $status = 1;
        $description = 'Defaults descriptions';

        foreach ($permissions as $permission)
        {
            Permission::create([
                'name' => $permission,
                'status' => $status,
                'description' => $description,
            ]);
        }
    }
}
