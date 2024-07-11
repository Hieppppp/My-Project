<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('admin.home.dashboard');
    })->name('dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/verify-email/{token}', [AuthController::class, 'verifyUser'])->name('user.verify');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::prefix('admin')->middleware(['auth', 'check-permission'])->group(function () {

    Route::resource('users', UserController::class);

    Route::get('/courses/export', [CourseController::class, 'export'])->name('export');
    Route::post('/courses/import', [CourseController::class, 'import'])->name('import');
    Route::resource('courses', CourseController::class);

    Route::resource('roles', RoleController::class);
    Route::get('roles/activate/{id}', [RoleController::class, 'activate'])->name('roles.activate');
    Route::get('roles/deactivate/{id}', [RoleController::class, 'deactivate'])->name('roles.deactivate');

    Route::resource('permissions', PermissionController::class);
    Route::get('permission/activate/{id}', [PermissionController::class, 'activate'])->name('permission.activate');
    Route::get('permission/deactivate/{id}', [PermissionController::class, 'deactivate'])->name('permission.deactivate');
});

