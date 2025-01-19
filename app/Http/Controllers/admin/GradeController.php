<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGradeRequest;
use App\Models\Department;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('students', 'department')->get();
        $department = Department::all();
        $title = 'Grade';

        return view('admin.Grade.index', compact('title', 'grades', 'department'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {

        Grade::create($request->validated());
        return redirect()->route('admin.grades.index')->with('success', 'Grade added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::with('students', 'Department')->findOrFail($id);
        return response()->json($grade);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grade = Grade::findOrFail($id);
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);
        $grade->update($validatedData);

        return redirect()->route('admin.grades.index')->with('success', 'Grade updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();
        return redirect()->route('admin.grades.index')->with('success', 'Grade deleted successfully!');
    }
}