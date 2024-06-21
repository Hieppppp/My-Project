<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(
        public BaseRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function getAll(int $parPage): mixed
    {
        return $this->repository->getAll($parPage);
    }

    public function create(array|null $params = null): User
    {
        return $this->repository->create($params);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, array $user)
    {
        return $this->repository->update($id, $user);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}