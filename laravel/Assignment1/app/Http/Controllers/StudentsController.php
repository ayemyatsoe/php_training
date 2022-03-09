<?php

namespace App\Http\Controllers;

use App\Students;
use App\Majors;
use Illuminate\Http\Request;
use App\Contracts\Services\StudentServiceInterface;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StudentResource;

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
        //return response([ 'items' => StudentResource::collection($items), 'message' => 'Retrieved successfully'], 200);
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
        //$response= response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);
        return redirect()->route('student.index')->with(['success'=>'Student created successfully.']);

    }


    public function show(Students $student)
    {

        $students = DB::table('Students')->where('id', 'student')->first();
        return view('students.show')->with([
            'student' => $student
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
        $items = $this->studentService->search($request);
        return view('students.index',['items' => $items]);
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
