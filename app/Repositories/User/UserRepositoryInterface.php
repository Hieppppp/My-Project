<?php

namespace App\Repositories\User;

use App\Models\User;


interface UserRepositoryInterface
{
    public function getAll(int $perPage): mixed;
    public function create(array $user): User;
    public function find($id);

    public function update($id, array $user);

    public function delete($id);

}
