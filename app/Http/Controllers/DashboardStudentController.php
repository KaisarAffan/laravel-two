<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardStudentController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Student::with(['Grade', 'Department']);

        if ($search) {
            $query->where('Nama', 'like', "%{$search}%")
                ->orWhereHas('Grade', function ($query) use ($search) {
                    $query->where('Name', 'like', "%{$search}%");
                });
        }

        $students = $query->get();
        $grades = Grade::all();

        return view('dashboard-student', [
            'title' => 'Student',
            'students' => $students,
            'grades' => $grades,
        ]);
    }


    public function create()
    {
        $grades = Grade::all();

        return view('students.create', [
            'title' => 'Add New Student',
            'grades' => $grades,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'Email' => 'required|email|unique:students,Email',
            'Alamat' => 'nullable|string|max:500',
        ]);

        Student::create($validated);

        return redirect()->route('dashboard-student')->with('success', 'Student added successfully!');
    }
}