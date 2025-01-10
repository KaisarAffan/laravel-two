<?php
namespace App\Services;
use App\Models\Student;
class StudentService
{
    public function
        getStudentsWithSearch(
        $search = null
    ) {
        $query = Student::with(['Grade', 'Department']);
        if ($search) {
            $query->
                where('Nama', 'like', "%{$search}%")
                ->orWhereHas('Grade', function ($query) use ($search) {
                    $query->where('Name', 'like', "%{$search}%");
                });
        }

        return $query->get();
    }
}
