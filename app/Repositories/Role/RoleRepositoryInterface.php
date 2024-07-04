<?php

namespace App\Repositories\Role;
use App\Models\Role;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
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
    public function delete(int $id): bool;
}