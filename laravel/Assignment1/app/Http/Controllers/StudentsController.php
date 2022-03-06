<?php

namespace App\Http\Controllers;

use App\Students;
use Illuminate\Http\Request;
use App\Contracts\Services\StudentServiceInterface;


class StudentsController extends Controller
{
    private $studentService;
    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $items = $this->studentService->getAll();

        return view('students.index', ['items' => $items]);

    }


    public function create()
    {
        $majors = $this->studentService->getMajor();
        return view('students.create', ['majors' => $majors]);
    }


    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required"],
            "email" => ["required", "unique:students,email"],
            "major_id" => ["required"],
            "dob" => ["required"],
            "address" => ["required"],
            "phone" => ["required"]

        ]);
        $this->studentService->create($request);
        return redirect()->route('student.index')->with('success','Student created successfully.');

    }


    public function show(Students $students)
    {
        return view('students.show')->with([
            'student' => $students
        ]);
    }


    public function edit(Students $student)
    {
        $majors = $this->studentService->getMajor();
        return view('students.edit')->with(['student' => $student, 'majors' => $majors]);
    }


    public function update(Request $request, Students $student)
    {
        $request->validate([
            "name" => ["required"],
            "email" => ["required", "unique:students,email"],
            "major_id" => ["required"],
            "dob" => ["required"],
            "address" => ["required"],
            "phone" => ["required"],
        ]);
         $this->studentService->update($request, $student);
        return redirect()->route('student.index')->with("success", "Student updated successfully");
    }


    public function destroy(Students $student)
    {
        $this->studentService->delete($student);
        //return dd("hello");
        return redirect()->back()->with("success", "Student deleted successfully");
    }
}
