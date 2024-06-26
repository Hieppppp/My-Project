<?php

namespace App\Repositories\User;

use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator;

  
}
