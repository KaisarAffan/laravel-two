<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
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
        $students = $this->studentService->getStudentsWithSearch($search)->paginate(20);
        $grades = Grade::all();
        $title = 'students';

        return view('admin.student.index', compact('title', 'students', 'grades', ));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route('admin.students.index')->with('success', 'Student added successfully!');
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id); // Find the student or fail if not found
        $grades = Grade::all(); // Fetch all grades for the dropdown
        return view('admin.students.edit', compact('student', 'grades'));
    }
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $validatedData = $request->validate([
            'Nama' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'Email' => 'required|email|max:255|unique:students,Email,' . $id,
            'Phone' => 'required|string|unique:students,Phone,' . $id,
            'Alamat' => 'nullable|string|max:255',
        ]);
        \Log::info('Before update: ', $student->toArray());
        $student->update($validatedData);
        \Log::info('After update: ', $student->fresh()->toArray());

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(string $id)
    {

        $student = Student::findOrFail($id);

        \Log::info('Student found: ', $student->toArray());
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}
