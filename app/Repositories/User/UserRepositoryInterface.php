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
     * @param array $user
     * 
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
     * @param string $userId
     * @param array $courseIds
     * 
     * @return void
     */
    public function syncCourses(string $userId, array $courseIds): void;

   
    /**
     * search user
     * 
     * @param mixed $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
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
