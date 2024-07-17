<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashBoardController::class, 'index'])->name('dashboard');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/verify-email/{token}', [AuthController::class, 'verifyUser'])->name('user.verify');

Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');



Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::middleware('permissions:view_user,create_user,update_user,delete_user')->group(function () {
        Route::resource('users', UserController::class)->where(['user' => '[0-9]+']);
        Route::delete('/users/delete-multiple', [UserController::class, 'deleteMultiRecord'])->name('users.deleteMultiRecord');
    });

    Route::middleware('permissions:view_course,create_course,update_course,delete_course,restore_course')->group(function () {
        Route::get('/courses/export', [CourseController::class, 'export'])->name('export')->middleware('permissions:export_excel');
        Route::post('/courses/import', [CourseController::class, 'import'])->name('import')->middleware('permissions:import_excel');
        Route::resource('courses', CourseController::class)->where(['course' => '[0-9]+']);
        Route::delete('/courses/delete-multiple', [CourseController::class, 'deleteMultiRecord'])->name('courses.deleteMultiRecord');
    });


    Route::middleware('role')->group(function () {
        Route::resource('roles', RoleController::class)->where(['role' => '[0-9]+']);
        Route::get('roles/activate/{id}', [RoleController::class, 'activate'])->name('roles.activate');
        Route::get('roles/deactivate/{id}', [RoleController::class, 'deactivate'])->name('roles.deactivate');

        Route::resource('permissions', PermissionController::class)->where(['permission' => '[0-9]+']);
        Route::get('permission/activate/{id}', [PermissionController::class, 'activate'])->name('permission.activate');
        Route::get('permission/deactivate/{id}', [PermissionController::class, 'deactivate'])->name('permission.deactivate');
    });

    
});






