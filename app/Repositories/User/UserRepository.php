<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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
        if (isset($user['password']) && !empty($user['password'])) {
            $user['password'] = bcrypt($user['password']);
        } else {
            unset($user['password']);
        }
        $existingUser->update($user);
        return $existingUser;
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

    /**
     * @param string|null $keyword
     * @param int $perPage
     * @param array|null $roles
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage, ?array $roles = null): LengthAwarePaginator
    {
        $query = User::query()
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'DESC');

        if (!empty($roles)) {
            $query->whereHas('roles', function ($roleQuery) use ($roles) {
                $roleQuery->whereIn('name', $roles);
            });
        }
        
        $users = $query->paginate($perPage);

        return $users;
    }
   
    /**
     * findByEmail
     *
     * @param  string $email
     * @return User
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    
    /**
     * deleteByIds
     *
     * @param  array $ids
     * @return int
     */
    public function deleteByIds(array $ids): int
    {
        return User::whereIn('id', $ids)->delete();
    }

    public function getUser(): Collection
    {
        return User::all();
    }
}
