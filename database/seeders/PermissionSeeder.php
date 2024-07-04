<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'restore',
            'forceDelete',
        ];

        $resources = [
            'user',
            'course',
        ];

        $status = 1; 
        $description = 'Default description'; 

        collect($resources)
            ->crossJoin($actions)
            ->map(function ($set) {
                return implode('.', $set);
            })
            ->each(function ($permission) use ($status, $description) {
                Permission::create([
                    'name' => $permission,
                    'status' => $status,
                    'description' => $description,
                ]);
            });
    }
}
