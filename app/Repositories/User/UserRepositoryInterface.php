<?php

namespace App\Repositories\User;

use App\Models\User;


interface UserRepositoryInterface
{
    /**
     * getAll
     *
     * @param  mixed $perPage
     * @return mixed
     */
    public function getAll(int $perPage): mixed;
    /**
     * create
     *
     * @param  mixed $user
     * @return User
     */
    public function create(array $user): User;
    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id);

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $user
     * @return void
     */
    public function update($id, array $user);

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
    public function searchUser($keyword, int $perPage): mixed;

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id);
}
