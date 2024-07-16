<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @param array $userData
     * 
     * @return User
     */
    public function create(array $userData): User;

    /**
     * update
     *
     * @param  int $id
     * @param  array $user
     * @param  array $courseId
     * @return User
     */
    public function update(int $id, array $userData): User;

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
    
    /**
     * register
     *
     * @param  array $data
     * @return User
     */
    public function register(array $data): User;
        
    /**
     * verifyUser
     *
     * @param  string $token
     * @return void
     */
    public function verifyUser(string $token);
    
    /**
     * deleteMultipleUser
     *
     * @param  array $ids
     * @return bool
     */
    public function deleteMultiRecord(array $ids): bool;

}
