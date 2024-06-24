<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

interface UserServiceInterface
{
    
    
    /**
     * get all user
     * 
     * @param int $parPage
     * 
     * @return Paginator
     */
    public function getAll(int $parPage): Paginator;
  
    
    /**
     * create
     * 
     * @param array|null|null $params
     * 
     * @return User
     */
    public function create(array|null $params = null): User;

    
    
    /**
     * find user by id
     * 
     * @param int $id
     * 
     * @return User|null
     */
    public function find(int $id): ?User;

    /**
     * update user
     * 
     * @param int $id
     * @param array $user
     * 
     * @return User
     */
    public function update(int $id, array $user): User;


    /**
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
