<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
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
        $this->createUserRole();
        $this->createCustomerRole();
       

    }

    protected function createRole(UserRole $role, Collection $permissions): void
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
        $permission = Permission::pluck('id');
        $this->createRole(UserRole::ADMIN(), $permission);
    }

    protected function createUserRole(): void
    {
        $permission = Permission::pluck('id');
        $this->createRole(UserRole::USER(), $permission);
    }

    protected function createCustomerRole(): void
    {
        $permission = Permission::pluck('id');
        $this->createRole(UserRole::CUSTOMER(), $permission);
    }

    

}
