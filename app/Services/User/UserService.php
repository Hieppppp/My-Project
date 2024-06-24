<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Http\UploadedFile;

class UserService extends BaseService implements UserServiceInterface
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public BaseRepository $repository
    ) {
        parent::__construct($repository);
    }

    /**
     * getAll
     *
     * @param  mixed $parPage
     * @return mixed
     */
    public function getAll(int $parPage): mixed
    {
        return $this->repository->getAll($parPage);
    }

    /**
     * create
     *
     * @param  mixed $params
     * @return User
     */
    public function create(array|null $params = null): User
    {
        if (isset($params['avatar'])) {
            $avatarName = time() . '.' . $params['avatar']->extension();
            $params['avatar']->move(public_path('avatar'), $avatarName);
            $params['avatar'] = $avatarName;
        }
        return $this->repository->create($params);
    }
    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $user
     * @return void
     */
    public function update($id, array $user)
    {
        if (isset($user['avatar']) && $user['avatar'] instanceof UploadedFile) {
            $user['avatar'] = $this->uploadAvatar($user['avatar']);
        }
        return $this->repository->update($id, $user);
    }

    /**
     * syncCourses
     *
     * @param  mixed $userId
     * @param  mixed $courseIds
     * @return void
     */
    public function syncCourses(string $userId, array $courseIds): void
    {
        $user = $this->repository->find($userId);
        $user->courses()->sync($courseIds);
    }
    
    /**
     * searchUser
     *
     * @param  mixed $keyword
     * @param  mixed $perPage
     * @return mixed
     */
    public function searchUser($keyword, int $perPage): mixed
    {
        return $this->repository->searchUser($keyword, $perPage);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    private function uploadAvatar(UploadedFile $avatar)
    {
        $avatarName = time() . '.' . $avatar->extension();
        $avatar->move(public_path('avatar'), $avatarName);
        return $avatarName;
    }
}
