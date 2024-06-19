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
     * create
     *
     * @param  User $user
     * @return User
     */
    public function create(array $user): User
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ]);
    }
}
