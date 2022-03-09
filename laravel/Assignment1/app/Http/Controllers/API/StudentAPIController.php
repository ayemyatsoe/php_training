<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Students;
use Response;
use Carbon\Carbon;
class StudentAPIController extends Controller
{

    public function index()
    {
        $students = Students::with("major")->latest()->get();
        return response()->json([
            "status" => "success",
            "message" => "All INformation success",
            "students" => $students
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'major_id'=>$request->major_id,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        Students::create($data);
        $response=Response::json(
            [
                'status'=>200,
                'message'=>'create success'
            ]
            );
         return $response;

    }

    public function show($id)
    {
        $data=Students::where('id',$id)->first();
        if(empty($data)){
         $response=Response::json(
             [
                 'status'=>200,
                 'message'=>'success',
                 'data'=>$data
             ]
             );
          return $response;
        }
        else {
         $response=Response::json(
             [
                 'status'=>200,
                 'message'=>'fail',
                 'data'=>$data
             ]
             );
          return $response;
        }
    }

    public function update(Request $request,$id){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'major_id'=>$request->major_id,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $check=Students::where('id',$request->id)->first();
        if(!empty($check)){
            Students::where('id',$request->id)->update($data);
            return Response::json(
                [
                    'status'=>200,
                    'message'=>'update'
                ]
                );
        }
        return Response::json(
            [
                'status'=>200,
                'message'=>'no data',
            ]
            );
    }

    public function delete($id)
    {
        $data=Students::where('id',$id)->first();
        if(empty($data)){
            $response=Response::json(
                [
                    'status'=>200,
                    'message'=>'No data',
                    'data'=>$data
                ]
                );
             return $response;
           }
        Students::where('id',$id)->delete();

        return Response::json(
            [
                'status'=>200,
                'message'=>'delete',
            ]
            );
    }
}
