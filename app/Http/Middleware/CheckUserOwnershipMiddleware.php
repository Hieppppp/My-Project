<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $userId = $request->route('user');

        if (!$this->userHasRole($user, UserRole::ADMIN()) && $user->id != $userId) {
            abort(404, 'Not Found');
        }
        
        return $next($request);
    }

    private function userHasRole(User $user, UserRole $role): bool
    {
        return $user->roles()->where('name', $role->value)->exists();
    }

}
