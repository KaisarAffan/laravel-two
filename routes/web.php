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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\StudentController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\admin\StudentController::class, 'create'])->name('create');
        Route::post('/Show', [\App\Http\Controllers\admin\StudentController::class, 'store'])->name('store');
        Route::put('/update/{student}', [\App\Http\Controllers\admin\StudentController::class, 'update'])->name('update');
        Route::delete('/delete/{student}', [\App\Http\Controllers\admin\StudentController::class, 'destroy'])->name('delete');
    });

    Route::prefix('grades')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\GradeController::class, 'index']);
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [\App\Http\Controllers\admin\DepartmentController::class, 'index']);
    });
});