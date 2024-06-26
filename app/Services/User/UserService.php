<?php

namespace App\Services\User;

use App\Models\Course;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;

/**
 * [Description UserService]
 */
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
     * find user by id
     * 
     * @param int $id
     * 
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return $this->repository->find($id);
    }

    /**
     * create user
     * 
     * @param array|null|null $params
     * 
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
     * update
     *
     * @param  int $id
     * @param  array $user
     * @param  array $courseIds
     * @return User
     */
    public function update(int $id, array $user, array $courseIds): User
    {
        $existingUser = $this->repository->find($id);

        $existingUser->courses()->sync($courseIds);

        if (isset($user['avatar']) && $user['avatar'] instanceof UploadedFile) {
            $this->deleteOldAvatar($existingUser->avatar);
            $user['avatar'] = $this->uploadAvatar($user['avatar']);
        }
        return $this->repository->update($id, $user);
    }

    /**
     * delete user 
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * search user
     * 
     * @param string|null $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->repository->pagination($keyword, $perPage);
    }

    /**
     * Upload avatar
     * 
     * @param UploadedFile $avatar
     * 
     * @return string
     */
    private function uploadAvatar(UploadedFile $avatar): string
    {
        $avatarName = time() . '.' . $avatar->extension();
        $avatar->move(public_path('avatar'), $avatarName);
        return $avatarName;
    }

    /**
     * delete old avatar
     * 
     * @param string|null $avatar
     * 
     * @return void
     */
    private function deleteOldAvatar(?string $avatar): void
    {
        if ($avatar && file_exists(public_path('avatar/' . $avatar))) {
            unlink(public_path('avatar/' . $avatar));
        }
    }
}
