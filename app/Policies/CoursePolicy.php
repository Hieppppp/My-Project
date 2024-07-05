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
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionName::VIEWANY_COURSE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::VIEW_COURSE) || $user->isAssociatedWithCourse($course);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionName::CREATE_COURSE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::UPDATE_COURSE) || $user->isAssociatedWithCourse($course);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::DELETE_COURSE) || $user->isAssociatedWithCourse($course);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::RESTORE_COURSE) || $user->isAssociatedWithCourse($course);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasPermission(PermissionName::FORCEDELETE_COURSE) || $user->isAssociatedWithCourse($course);
    }
}
