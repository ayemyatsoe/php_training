<?php

namespace App\Http\Controllers;

use App\Post;
use App\Majors;
use App\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class StudentAjaxController extends Controller
{
    public function index()
    {
        $items = Students::with("major")->latest()->get();
        return response()->json(['code'=>200, 'message'=>'Post list successfully','items' => $items], 200);
    }

    public function create()
    {
        $majors =Majors::orderBy("name")->get()->pluck("name", "id");
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
        $post = Students::updateOrCreate(['id' => $request->id], [
                'name' => $request->name,
                'email' => $request->email,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'major_id'=>$request->major_id,
                'address'=>$request->address,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                ]);
        return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);

    }

    public function show($id)
    {
        $post = Students::find($id);
        return response()->json($post);
    }



   public function destroy($id)
    {
      Students::find($id)->delete();
      return response()->json(['success'=>'Post Deleted successfully']);
    }

    public function edit($id)
    {
        $student = Students::find($id);
        return response()->json($student);
    }

}