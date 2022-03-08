<?php

namespace App\Http\Controllers;

use App\Students;
use Illuminate\Http\Request;
use App\Contracts\Services\StudentServiceInterface;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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


    public function show(Students $student)
    {
        return view('students.show')->with([
            'student' => $student
        ]);
        //$students = DB::table('Students')->where('id', 'student')->first();
        dd($students);
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
        return redirect()->back()->with("success", "Student deleted successfully");
    }

    public function importExportView()
    {
       return view('students.import');
    }
    public function export()
    {
        return Excel::download(new StudentsExport, 'users.csv');
    }

    public function import()
    {
        Excel::import(new StudentsImport,request()->file('file'));

        return back();
    }
    public function search(Request $request){

        $search = $request->input('search');

        $items = Students::query()
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('dob', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere(function ($query) use ($search) {
                        $query->whereHas('major', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%');
                        });
                    })->get();

        return view('students.index', compact('items'));
    }

    public function date(Request $request)
    {
       
        $start_date = Carbon::parse($request->start_date)
        ->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)
        ->toDateTimeString();
        $items = Students::whereBetween('created_at',[$start_date,$end_date])->get();
        dd($data->toArray());
        //return User::whereBetween('created_at',[$start_date,$end_date])->get();

    }
    public function dateView()
    {
        return view('students.search');

    }
}