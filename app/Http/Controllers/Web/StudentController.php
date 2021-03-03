<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Student',
            'page_header' => 'Students List',
            'students' => Student::latest()->get(),
        ];

        return view('dashboard.student.index')->with(array_merge($this->data, $data));
    }

    public function show(Student $student, $id)
    {
        $data = [
            'page_title' => 'Student Details',
            'page_header' => 'Students Details',
            'student' => $student->findOrFail($id),
        ];

        return view('dashboard.student.show')->with(array_merge($this->data, $data));
    }
}
