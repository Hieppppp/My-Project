<?php

namespace App\Repositories\User;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface UserRepositoryInterface
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
     * @param array $user
     * 
     * @return User
     */
    public function create(array $user): User;
   
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
     * @param array|null $roles
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage, ?array $roles = null): LengthAwarePaginator;
    
    /**
     * findByEmail
     *
     * @param  string $email
     * @return User
     */
    public function findByEmail(string $email): ?User;
    
    /**
     * deleteByIds
     *
     * @param  array $ids
     * @return int
     */
    public function deleteByIds(array $ids): int;

  
}
