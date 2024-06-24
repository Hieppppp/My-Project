<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param int $perPage
     * 
     * @return mixed
     */
    public function getAll(int $perPage): mixed
    {
        return User::with('courses')->paginate($perPage);
    }

    /**
     * @param array $user
     * 
     * @return User
     */
    /**
     * create
     *
     * @param  mixed $user
     * @return User
     */
    public function create(array $user): User
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'date_of_birth' => $user['date_of_birth'],
            'phone' => $user['phone'],
            'avatar' => $user['avatar'],
        ]);
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function find($id)
    {
        return User::with('courses')->findOrFail($id);
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
        $results = User::findOrFail($id);
        if ($results) {
            $results->update($user);
            return $results;
        }
        return false;
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
        $user = $this->find($userId);
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
        return User::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar) {
            $avatarPath = public_path('avatar') . '/' . $user->avatar;
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
        }
        return $user->delete();
    }
}
