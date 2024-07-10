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
            PermissionName::VIEW,
            PermissionName::CREATE,
            PermissionName::UPDATE,
            PermissionName::DELETE,
            PermissionName::RESTORE,
            PermissionName::FORCEDELETE,

            PermissionName::VIEW_COURSE,
            PermissionName::CREATE_COURSE,
            PermissionName::UPDATE_COURSE,
            PermissionName::DELETE_COURSE,
            PermissionName::RESTORE_COURSE,
            PermissionName::FORCEDELETE_COURSE,
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
