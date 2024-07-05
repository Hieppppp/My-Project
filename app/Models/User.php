<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleName;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'phone',
        'avatar',
    ];

    /**
     * roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
    /**
     * groups
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_group');
    }

    /**
     * courses
     *
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * isAdmin
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(UserRole::ADMIN());
    }

    /**
     * isUser
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->hasRole(UserRole::USER());
    }

    /**
     * isCustomer
     *
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->hasRole(UserRole::CUSTOMER());
    }

    /**
     * hasRole
     *
     * @param  UserRole $role
     * @return bool
     */
    public function hasRole(UserRole $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }


    public function permissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions')->flatten()->pluck('name')->unique();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->contains($permission);
    }

    public function isAssociatedWithCourse(Course $course): bool
    {
        return $this->courses->contains($course);
    }
}
