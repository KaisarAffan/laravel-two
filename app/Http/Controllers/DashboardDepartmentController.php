<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DashboardDepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('dashboard-department', [
            'title' => 'Department',
            'department' => $department
        ]);
    }
}