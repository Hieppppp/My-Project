<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;    
    /**
     * view
     *
     * @param  User $user
     * @param  Course $course
     * @return bool
     */
    public function view(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::VIEW_COURSE);
    }
   
    /**
     * create
     *
     * @param  User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionName::CREATE_COURSE);
    }

    /**
     * Determine whether the user can update the model.
     */    
    /**
     * update
     *
     * @param  User $user
     * @param  Course $course
     * @return bool
     */
    public function update(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::UPDATE_COURSE);
        
    }

    /**
     * Determine whether the user can delete the model.
     */    
    /**
     * delete
     *
     * @param  User $user
     * @param  Course $course
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission(PermissionName::DELETE_COURSE);
        
    }

    /**
     * Determine whether the user can restore the model.
     */    
    /**
     * restore
     *
     * @param  User $user
     * @param  Course $course
     * @return bool
     */
    public function restore(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::RESTORE_COURSE);
    }

  
}
