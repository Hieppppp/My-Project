<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

interface UserRepositoryInterface
{
    
    /**
     * get all user
     * 
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getAll(int $perPage): Paginator;
    /**
     * create
     *
     * @param  mixed $user
     * @return User
     */
    public function create(array $user): User;
   
    /**
     * find user by id
     * 
     * @param int $id
     * 
     * @return User|null
     */
    public function find(int $id): ?User;
   
    
    /**
     * update
     * 
     * @param int $id
     * @param array $user
     * 
     * @return User
     */
    public function update(int $id, array $user): User;

    /**
     * syncCourses
     *
     * @param  mixed $userId
     * @param  mixed $courseIds
     * @return void
     */
    public function syncCourses(string $userId, array $courseIds): void;

    /**
     * searchUser
     *
     * @param  mixed $keyword
     * @param  mixed $perPage
     * @return mixed
     */
    public function searchUser($keyword, int $perPage): LengthAwarePaginator;

    /**
     * delete user
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
