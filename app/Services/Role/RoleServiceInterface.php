<?php

namespace App\Services\Role;

use App\Models\Role;
use Illuminate\Support\Collection;

interface RoleServiceInterface
{    
    /**
     * getRole
     *
     * @return Collection
     */
    public function getRole(): Collection;

    /**
     * findById
     *
     * @param  int $id
     * @return Role
     */
    public function findById(int $id): ?Role;
    
    /**
     * create
     *
     * @param  array $role
     * @return Role
     */
    public function create(array $role): Role;
    
    /**
     * update
     *
     * @param  int $id
     * @param  array $role
     * @return Role
     */
    public function update(int $id, array $role): Role;
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id):bool;
    
    /**
     * active
     *
     * @param  int $id
     * @return bool
     */
    public function active(int $id): bool;
    
    /**
     * inactive
     *
     * @param  int $id
     * @return bool
     */
    public function inactive(int $id): bool;

    
}