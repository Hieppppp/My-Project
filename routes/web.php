<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin.home.dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/courses/export', [CourseController::class, 'export'])->name('export');
    Route::post('/courses/import', [CourseController::class, 'import'])->name('import');
});

