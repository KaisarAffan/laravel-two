<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DashboardDepartmentController;
use App\Http\Controllers\DashboardGradeController;
use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::get('/student', [StudentController::class, 'index']);
Route::get('/grade', [GradeController::class, 'index']);
Route::get('/department', [DepartmentController::class, 'index']);
Route::get('/dashboard', [dashboardController::class, 'index']);

Route::get('/dashboard-student', [DashboardStudentController::class, 'index'])->name('dashboard-student');
Route::get('/dashboard-grade', [DashboardGradeController::class, 'index']);
Route::get('/dashboard-department', [DashboardDepartmentController::class, 'index']);

Route::post('/studentsShow', [DashboardStudentController::class, 'store'])->name('students.store');