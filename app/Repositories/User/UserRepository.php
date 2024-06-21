<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
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
    public function find($id){
        return User::with('courses')->findOrFail($id);
    }

    /**
     * @param mixed $id
     * @param array $user
     * 
     * @return [type]
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
     * @param mixed $id
     * 
     * @return [type]
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



