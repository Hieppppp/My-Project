<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleName;
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
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
    
    /**
     * isAdmin
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::ADMIN);
    }
    
    /**
     * isUser
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->hasRole(RoleName::USER);
    }
    
    /**
     * isCustomer
     *
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->hasRole(RoleName::CUSTOMER);
    }
    
    /**
     * hasRole
     *
     * @param  RoleName $role
     * @return bool
     */
    public function hasRole(RoleName $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }
    
    // /**
    //  * permissions
    //  *
    //  * @return array
    //  */
    // public function permissions(): array
    // {
    //     return $this->roles()->with('permissions')->get()
    //         ->map(function ($role) {
    //             return $role->permissions->pluck('name');
    //         })->flatten()->values()->unique()->toArray();
    // }
    
    // /**
    //  * hasPermission
    //  *
    //  * @param  string $permission
    //  * @return bool
    //  */
    // public function hasPermission(string $permission): bool
    // {
    //     return in_array($permission, $this->permissions(), true);
    // }

    public function permissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions')->flatten()->pluck('name')->unique();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->contains($permission);
    }
    
    // public function hasPermission(string $permission): bool
    // {
    //     return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
    //         $query->where('name', $permission);
    //     })->exists();
    // }

    // public function getPermissions(): array
    // {
    //     return $this->roles()->with('permissions')->get()
    //         ->pluck('permissions')->flatten()->pluck('name')->unique()->toArray();
    // }

    
}
