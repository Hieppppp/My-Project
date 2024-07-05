<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $currentRouteName = Route::currentRouteName();

        if (!$user) {
            return redirect()->route('login');
        }

        // Kiểm tra quyền của người dùng
        if (!$this->hasPermission($user, $currentRouteName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    /**
     * Kiểm tra xem người dùng có quyền truy cập route hiện tại hay không
     *
     * @param $user
     * @param $routeName
     * @return bool
     */
    private function hasPermission($user, $routeName): bool
    {
        // Lấy tất cả các quyền của người dùng
        $userPermissions = $user->permissions()->pluck('name')->toArray();

        // Danh sách quyền cần thiết cho mỗi route
        $routePermissions = [
            'export' => ['export_courses'],
            'courses.index' => ['view_courses'],
            'courses.create' => ['create_courses'],
            'courses.store' => ['create_courses'],
            'courses.edit' => ['edit_courses'],
            'courses.update' => ['edit_courses'],
            'courses.destroy' => ['delete_courses'],
            'users.index' => ['view_users'],
            'roles.index' => ['view_roles'],
            'roles.activate' => ['activate_roles'],
            'roles.deactivate' => ['deactivate_roles'],
            'permissions.index' => ['view_permissions'],
            'permission.activate' => ['activate_permissions'],
            'permission.deactivate' => ['deactivate_permissions'],
            'import' => ['import_courses'],
        ];

        $requiredPermissions = $routePermissions[$routeName] ?? [];

        // Kiểm tra xem người dùng có tất cả các quyền cần thiết không
        foreach ($requiredPermissions as $permission) {
            if (!in_array($permission, $userPermissions)) {
                return false;
            }
        }

        return true;
    }
}
