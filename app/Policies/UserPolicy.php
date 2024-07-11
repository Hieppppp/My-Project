<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the model.
     */    
    /**
     * view
     *
     * @param  User $user
     * @param  User $targetUser
     * @return bool
     */
    public function view_user(User $user): bool
    {
        return $user->hasPermission(PermissionName::VIEW_USER);
    }

    /**
     * Determine whether the user can create models.
     */    
    /**
     * create
     *
     * @param  User $user
     * @return bool
     */
    public function create_user(User $user): bool
    {
        return $user->hasPermission(PermissionName::CREATE_USER);
    }

    /**
     * Determine whether the user can update the model.
     */    
    /**
     * update
     *
     * @param  User $user
     * @param  User $targetUser
     * @return bool
     */
    public function update_user(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */    
    /**
     * delete
     *
     * @param  User $user
     * @return bool
     */
    public function delete_user(User $user, User $targetUser): bool
    {
        if ($user->hasPermission(PermissionName::DELETE_USER) && !$targetUser->hasRole(UserRole::ADMIN())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */    
    /**
     * restore
     *
     * @param  User $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->hasPermission(PermissionName::RESTORE_USER);
    }

    
    
}
