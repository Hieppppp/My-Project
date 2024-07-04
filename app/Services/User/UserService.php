<?php

namespace App\Services\User;


use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;


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
     * create
     *
     * @param  array $userData
     * @return User
     */
    public function create(array $userData): User
    {
        if (isset($userData['avatar']) && $userData['avatar'] instanceof UploadedFile) {
            $avatarName = time() . '.' . $userData['avatar']->extension();
            $userData['avatar']->move(public_path('avatar'), $avatarName);
            $userData['avatar'] = $avatarName;
        }

        if (isset($userData['courses'])) {
            $courseIds = $userData['courses'];
            unset($userData['courses']);
        }

        if (isset($userData['roles'])) {
            $roleIds = $userData['roles'];
            unset($userData['roles']);
        }

        $user = $this->repository->create($userData);

        if (isset($courseIds)) {
            $user->courses()->attach($courseIds);
        }

        if (isset($roleIds)) {
            $user->roles()->sync($roleIds);
        }

        return $user;
    }


    /**
     * update
     *
     * @param  int $id
     * @param  array $user
     * @param  array $courseIds
     * @return User
     */
    public function update(int $id, array $userData): User
    {
        $existingUser = $this->repository->find($id);

        if (isset($userData['courses'])) {
            $courseIds = $userData['courses'];
            unset($userData['courses']);
            $existingUser->courses()->sync($courseIds);
        }

        if (isset($userData['roles'])) {
            $rolesIds = $userData['roles'];
            unset($userData['roles']);
            $existingUser->roles()->sync($rolesIds);
        }

        if (isset($user['avatar']) && $userData['avatar'] instanceof UploadedFile) {
            $this->deleteOldAvatar($existingUser->avatar);
            $user['avatar'] = $this->uploadAvatar($userData['avatar']);
        }
        return $this->repository->update($id, $userData);
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
