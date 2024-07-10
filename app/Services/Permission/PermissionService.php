<?php

namespace App\Services\Permission;

use App\Models\Permission;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    public function __construct(
        public BaseRepository $repository
    )
    {
        parent::__construct($repository);
    }    
    /**
     * getPermission
     *
     * @return Collection
     */
    public function getPermission(): Collection
    {
        return $this->repository->getPermission();
    }
    
    /**
     * findById
     *
     * @param  int $id
     * @return Permission
     */
    public function findById(int $id): Permission|null
    {
        return $this->repository->findById($id);
    }
    
    /**
     * create
     *
     * @param  array $params
     * @return Permission
     */
    public function create(array $params): Permission
    {
        return $this->repository->create($params);
    }
    
    /**
     * update
     *
     * @param  int $id
     * @param  array $permission
     * @return Permission
     */
    public function update(int $id, array $permission): Permission
    {
        return $this->repository->update($id, $permission);
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
        $permission = $this->findById($id);
        if ($permission) {
            $permission->status = 1;
            return $permission->save();
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
        $permission = $this->findById($id);
        if ($permission) {
            $permission->status = 0;
            return $permission->save();
        }
        return false;
    }
    
    /**
     * pagination
     *
     * @param  string|null $keyword
     * @param  int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->repository->pagination($keyword, $perPage);
    }
}