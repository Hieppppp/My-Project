<?php

namespace App\Policies;

use App\Enums\PermissionName;
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
    public function view(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id || $user->hasPermission(PermissionName::VIEW);
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
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionName::CREATE);
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
    public function update(User $user, User $targetUser): bool
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
    public function delete(User $user): bool
    {
        return $user->hasPermission(PermissionName::DELETE);
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
        return $user->hasPermission(PermissionName::RESTORE);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */    
    /**
     * forceDelete
     *
     * @param  User $user
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasPermission(PermissionName::FORCEDELETE);
    }
}
