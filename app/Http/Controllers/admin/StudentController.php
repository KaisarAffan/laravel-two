<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Http\request\StoreStudentRequest;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $students = $this->studentService->getStudentsWithSearch($search);
        $grades = Grade::all();
        $title = 'students';

        return view('admin.student.index', compact('title', 'students', 'grades', ));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $grades = Grade::all();
        return view('students.create', compact('grades'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route('admin.student.index')->with('success', 'Student added successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.student.index')->with('success', 'Student deleted successfully!');
    }
}