<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    
    /**
     * handle
     *
     * @param  Request $request
     * @param  Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next, ): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $currentRouteName = $request->route()->getName();


        if (!$this->hasPermissionForRoute($user, $currentRouteName)) {
            abort(404, 'Not Found.');
        }

        return $next($request);
    }

  
    
    /**
     * hasPermissionForRoute
     *
     * @param  User $user
     * @param  string $routeName
     * @return bool
     */
    private function hasPermissionForRoute(User $user, string $routeName): bool
    {
        if ($user->isAdmin())
        {
            return true;
        }
       
        $routePermissions = config('permissions.routes');

        $requiredPermissions = $routePermissions[$routeName] ?? [];

        foreach ($requiredPermissions as $permission) {
            if (!$user->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

   
    


}
