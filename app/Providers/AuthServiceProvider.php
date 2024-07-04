<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true; 
            }

        });

        $this->registerPolicies();
        $this->registerGates();

    }

    protected function registerGates(): void
    {
        try {
            // $permissions = Permission::pluck('name');

            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function (User $user) use ($permission){
                    return $user->hasPermission($permission->name);
                });
            }

            // Gate::define('views.course', function ($user) {
            //     return $user->isCustomer();
            // });

        } catch (\Throwable $th) {
            info('registerGates(): Database not found or not yet migrated. Ignoring user permission while booting app.');
        }
    }

    
}
