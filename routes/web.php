<?php

use App\Http\Controllers\Admin\CourseController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/courses/export', [CourseController::class, 'export'])->name('export');
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::post('/courses/import', [CourseController::class, 'import'])->name('import');
});


