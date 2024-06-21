<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function getAll(int $parPage): mixed;
    public function create(array|null $params = null): User;

    public function find($id);

    public function update($id, array $user);

    public function delete($id);
}