<?php

namespace App\Providers;

use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Course\CourseService;
use App\Services\Course\CourseServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $courseRepository = $this->app->get(CourseRepositoryInterface::class);

        $userRepository = $this->app->get(UserRepositoryInterface::class);


        $this->app->bind(CourseServiceInterface::class, function () use ($courseRepository) {
            return new CourseService($courseRepository);
        });

        $this->app->bind(UserServiceInterface::class, function () use ($userRepository) {
            return new UserService($userRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        
    }
}
