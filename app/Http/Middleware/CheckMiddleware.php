<?php

namespace App\Http\Middleware;

use App\Enums\PermissionName;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $currentRouteName = $request->route()->getName();

        if (!$this->hasPermissionForRoute($user, $currentRouteName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    private function hasPermissionForRoute($user, $routeName): bool
    {
        if ($user->isAdmin()) {
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
