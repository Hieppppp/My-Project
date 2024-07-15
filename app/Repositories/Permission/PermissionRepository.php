<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\BaseRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Permission::class);
    }
    
    /**
     * getPermission
     *
     * @return Collection
     */
    public function getPermission(): Collection
    {
        return Permission::where('status', 1)->get();
    }
    
    /**
     * findById
     *
     * @param  int $id
     * @return Permission
     */
    public function findById(int $id): Permission|null
    {
        return Permission::findOrFail($id);
    }
    
    /**
     * create
     *
     * @param  array $permission
     * @return Permission
     */
    public function create(array $permission): Permission
    {
        return Permission::create([
            'name' => $permission['name'],
            'description' => $permission['description'],
            'status' => $permission['status'],
        ]);
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
        $results = Permission::findOrFail($id);
        $results->update($permission);
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
        $permission = Permission::findOrFail($id);
        return $permission->delete();
    }
    
    /**
     * pagination
     *
     * @param  string|null $keyword
     * @param  int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(string|null $keyword, int $perPage): LengthAwarePaginator
    {
        return Permission::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('status', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
    }

   
}