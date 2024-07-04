<?php

namespace App\Providers;

use App\Repositories\Course\CourseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
       
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
