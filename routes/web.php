<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('admin.home.dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check-permission']], function () {
    
    Route::get('/courses/export', [CourseController::class, 'export'])->name('export');

    Route::resource('courses', CourseController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('role/activate/{id}', [RoleController::class, 'activate'])->name('roles.activate');
    Route::get('role/deactivate/{id}', [RoleController::class, 'deactivate'])->name('roles.deactivate');

    Route::resource('permissions', PermissionController::class);

    Route::get('permission/activate/{id}', [PermissionController::class, 'activate'])->name('permission.activate');
    Route::get('permission/deactivate/{id}', [PermissionController::class, 'deactivate'])->name('permission.deactivate');
    Route::post('/courses/import', [CourseController::class, 'import'])->name('import');
});




