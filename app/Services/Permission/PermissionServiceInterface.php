<?php

namespace App\Services\Permission;

use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PermissionServiceInterface
{       
    /**
     * getPermission
     *
     * @return Collection
     */
    public function getPermission(): Collection;

    /**
     * findById
     *
     * @param  int $id
     * @return Permission
     */
    public function findById(int $id): ?Permission;
    
    /**
     * create
     *
     * @param  array $params
     * @return Permission
     */
    public function create(array $params): Permission;
    
    /**
     * update
     *
     * @param  int $id
     * @param  array $permission
     * @return Permission
     */
    public function update(int $id, array $permission): Permission;
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool;
    
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
    
    /**
     * pagination
     *
     * @param  string|null $keyword
     * @param  int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator;
}