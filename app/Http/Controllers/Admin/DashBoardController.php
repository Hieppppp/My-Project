<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class DashBoardController extends Controller
{
    public $user;

    public function index()
    {
        $total_users = count(User::select('id')->get());
        $total_courses = count(Course::select('id')->get());
        $total_roles = count(Role::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());

        return view('admin.home.dashboard', compact('total_users', 'total_courses', 'total_roles', 'total_permissions'));
    }
}
