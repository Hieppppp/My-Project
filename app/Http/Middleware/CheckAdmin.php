<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
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

        // Check if the user has the ADMIN role
        if (!$this->userHasRole($user, UserRole::ADMIN())) {
            abort(404, 'Not Found');
        }

        return $next($request);
    }

    private function userHasRole($user, UserRole $role): bool
    {
        return $user->roles()->where('name', $role->value)->exists();
    }
}
