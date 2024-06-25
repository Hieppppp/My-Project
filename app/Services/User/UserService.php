<?php

namespace App\Services\User;

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
     * get all user
     * 
     * @param int $parPage
     * 
     * @return Paginator
     */
    public function getAll(int $parPage): Paginator
    {
        return $this->repository->getAll($parPage);
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
     * update user
     * 
     * @param int $id
     * @param array $user
     * 
     * @return User
     */
    public function update(int $id, array $user): User
    {
        $existingUser = $this->repository->find($id);

        if (isset($user['avatar']) && $user['avatar'] instanceof UploadedFile) {
           
            $this->deleteOldAvatar($existingUser->avatar);

            $user['avatar'] = $this->uploadAvatar($user['avatar']);
        }

       

        return $this->repository->update($id, $user);
    }

   
    /**
     * syncCourses
     * 
     * @param string $userId
     * @param array $courseIds
     * 
     * @return void
     */
    public function syncCourses(string $userId, array $courseIds): void
    {
        $user = $this->repository->find($userId);
        $user->courses()->sync($courseIds);
    }
    
    /**
     * search user
     * 
     * @param string $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function searchUser($keyword, int $perPage): LengthAwarePaginator
    {
        return $this->repository->searchUser($keyword, $perPage);
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
