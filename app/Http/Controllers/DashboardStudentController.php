<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class DashboardStudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['Grade', 'Department'])->get();
        return view('dashboard-student', [
            'title' => 'Student',
            'students' => $students,
            //'students' => Student::all(),
        ]);
    }
}