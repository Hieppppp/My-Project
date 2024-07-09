<?php

namespace App\Services\User;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VerificationToken;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        if (isset($userData['avatar']) && $userData['avatar'] instanceof UploadedFile) {
            $this->deleteOldAvatar($existingUser->avatar);
            $userData['avatar'] = $this->uploadAvatar($userData['avatar']);
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
    
    /**
     * register
     *
     * @param  array $data
     * @return User
     */
    public function register(array $data): User
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->date_of_birth = $data['date_of_birth'] ?? date('Y-m-d');
        $user->phone = $data['phone'] ?? 'null';
        $user->avatar = $data['avatar'] ?? 'null';
        $user->save();

        $user->assignRole(UserRole::USER);

        $token = base64_encode(Str::random(64));

        VerificationToken::create([
            'user_type' => UserRole::USER,
            'email' => $data['email'],
            'token' => $token,
        ]);

        $actionLink = route('user.verify', ['token' => $token]);

        $mailData = [
            'action_links' => $actionLink,
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        Mail::send('admin.mail.verify_email', $mailData, function ($message) use ($mailData) {
            $message->to($mailData['email']);
            $message->subject('Verify Your Email');
        });

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyToken = VerificationToken::where('token', $token)->first();

        if (!is_null($verifyToken)) {
            $user = User::where('email', $verifyToken->email)->first();

            if (!$user->verified) {
                $user->verified = 1;
                $user->save();

                return 'Email has been verified';
            } else {
                return 'Email has already been verified';
            }
        } else {
            return 'Invalid verification code';
        }
    }
}
