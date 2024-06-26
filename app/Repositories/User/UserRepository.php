<?php

namespace App\Repositories\User;

use App\Models\Course;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
     * get all user
     * 
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getAll(int $perPage): Paginator
    {
        return User::with('courses')->paginate($perPage);
    }
    
    /**
     * getAllCourse
     *
     * @return void
     */
    public function getAllCourse()
    {
        return Course::all();
    }

    /**
     * create
     * 
     * @param array $user
     * 
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
     * find user by id
     * 
     * @param int $id
     * 
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::with('courses')->findOrFail($id);
    }

    /**
     * update user
     * 
     * @param int $id
     * @param array $user
     * 
     * @return User|false 
     */
    public function update(int $id, array $user): User
    {
        $existingUser = User::findOrFail($id);
        $existingUser->update($user);
        return $existingUser;
    }

    /**
     * @param string|null $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator
    {
        return User::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
    }

    /**
     * delete user
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
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
