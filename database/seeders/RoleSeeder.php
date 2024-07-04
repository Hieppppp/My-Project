<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use Illuminate\Database\Seeder;
use App\Enums\UserType;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();
    }

    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create([
            'name' => $role->value,
            'description' => 'Default description', 
            'status' => 1, 
        ]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'user.%')
            ->pluck('id');
        $this->createRole(RoleName::ADMIN, $permissions);
    }

}
