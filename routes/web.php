<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::get('/student', [StudentController::class, 'index']);
Route::get('/grade', [GradeController::class, 'index']);
Route::get('/department', [DepartmentController::class, 'index']);

Route::prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('students')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\StudentController::class, 'index'])->name('admin.students.store');
        Route::post('/Show', [\App\Http\Controllers\admin\StudentController::class, 'store'])->name('students.store');
    });

    Route::prefix('grades')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\GradeController::class, 'index']);
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\DepartmentController::class, 'index']);
    });
});
