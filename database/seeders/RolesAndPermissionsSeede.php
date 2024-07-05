<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RolesAndPermissionsSeede extends Seeder
{
    protected function createPermission(PermissionName $permissionName): void
    {
        $newPermission = Permission::create([
            'name' => $permissionName->value,
            'description' => 'Default description',
            'status' => 1,
        ]);
        $newPermission->save();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            PermissionName::VIEWANY,
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
        ];

        $description = 'Defaults description';

        $status = 1;

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
