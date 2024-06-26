<?php

namespace App\Services\User;

use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * [Description UserServiceInterface]
 */
interface UserServiceInterface
{

    /**
     * find user by id
     * 
     * @param int $id
     * 
     * @return User|null
     */
    public function find(int $id): ?User;
  
    /**
     * create
     * 
     * @param array|null|null $params
     * 
     * @return User
     */
    public function create(array|null $params = null): User;

    /**
     * update
     *
     * @param  int $id
     * @param  array $user
     * @param  array $courseId
     * @return User
     */
    public function update(int $id, array $user, array $courseId): User;

    /**
     * delete user
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * search user
     * 
     * @param string|null $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator;

}
