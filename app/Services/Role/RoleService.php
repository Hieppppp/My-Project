<?php

namespace App\Services\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Services\Role\RoleServiceInterface;
use App\Services\BaseService;
use Illuminate\Support\Collection;

class RoleService extends BaseService implements RoleServiceInterface
{
    public function __construct(
        public BaseRepository $repository
    ) {
        parent::__construct($repository);
    }
        
    /**
     * getRole
     *
     * @return Collection
     */
    public function getRole(): Collection
    {
        return $this->repository->getRole();
    }

    /**
     * findById
     *
     * @param  int $id
     * @return Role
     */
    public function findById(int $id): Role|null
    {
        return $this->repository->findById($id);
    }

    /**
     * create
     *
     * @param  array $role
     * @return Role
     */
    public function create(array $role): Role
    {
        if (isset($role['permissions'])) {
            $permissionIds = $role['permissions'];
            unset($role['permissions']);
        }

        $results = $this->repository->create($role);

        if (isset($permissionIds)) {
            $results->permissions()->attach($permissionIds);
        }

        return $results;
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
        $existRole = $this->repository->findById($id);

        if (isset($role['permissions'])) {
            $permissionIds = $role['permissions'];
            unset($role['permissions']);
            $existRole->permissions()->sync($permissionIds);
        }
        
        return $this->repository->update($id, $role);
    }
    

    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * active
     *
     * @param  int $id
     * @return bool
     */
    public function active(int $id): bool
    {
        $role = $this->findById($id);
        if ($role) {
            $role->status = 1;
            return $role->save();
        }
        return false;
    }

    /**
     * inactive
     *
     * @param  int $id
     * @return bool
     */
    public function inactive(int $id): bool
    {
        $role = $this->findById($id);
        if ($role) {
            $role->status = 0;
            return $role->save();
        }
        return false;
    }
}
