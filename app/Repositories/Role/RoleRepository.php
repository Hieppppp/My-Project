<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Collection;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Role::class);
    }
    
    /**
     * getRole
     *
     * @return Collection
     */
    public function getRole(): Collection
    {
        return Role::all();
    }
    
    /**
     * findById
     *
     * @param  int $id
     * @return Role|null
     */
    public function findById(int $id): Role|null
    {
        return Role::findOrFail($id);
    }
    
    /**
     * create
     *
     * @param  array $role
     * @return Role
     */
    public function create(array $role): Role
    {
        return Role::create([
           'name' => $role['name'],
           'description' => $role['description'],
           'status' => $role['status'], 
        ]);
    }
    
    /**
     * update
     *
     * @param  int $id
     * @param  array $role
     * @return Role
     */
    public function update(int $id, array $role): Role
    {
        $results = Role::findOrFail($id);
        $results->update($role);
        return $results;
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $role = Role::findOrFail($id);
        return $role->delete();
    }
}