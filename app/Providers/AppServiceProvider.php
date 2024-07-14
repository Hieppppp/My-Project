<?php

namespace App\Providers;

use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Course\CourseService;
use App\Services\Course\CourseServiceInterface;
use App\Services\DeMo\DeMoService;
use App\Services\Permission\PermissionService;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleService;
use App\Services\Role\RoleServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     

        $courseRepository = $this->app->get(CourseRepositoryInterface::class);

        $userRepository = $this->app->get(UserRepositoryInterface::class);

        $roleRepository = $this->app->get(RoleRepositoryInterface::class);

        $permissionRepository = $this->app->get(PermissionRepositoryInterface::class);


        $this->app->bind(CourseServiceInterface::class, function () use ($courseRepository) {
            return new CourseService($courseRepository);
        });

        $this->app->bind(UserServiceInterface::class, function () use ($userRepository) {
            return new UserService($userRepository);
        });

        $this->app->bind(RoleServiceInterface::class, function () use($roleRepository) {
            return new RoleService(($roleRepository));
        });
        
        $this->app->bind(PermissionServiceInterface::class, function () use ($permissionRepository) {
            return new PermissionService($permissionRepository);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
       
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        
    }
}
