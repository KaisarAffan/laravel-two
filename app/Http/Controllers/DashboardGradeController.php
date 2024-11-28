<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardGradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('dashboard-grade', [
            'title' => 'Grade',
            'grade' => $grades->load('students', 'department')
        ]);
    }
}